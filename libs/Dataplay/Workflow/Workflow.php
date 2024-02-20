<?php

namespace Libs\Dataplay\Workflow;

use Illuminate\Support\Str;
use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Workflow
{
    public const POOL_BEFORE = 'before';
    public const POOL_DEFAULT = 'default';
    public const POOL_AFTER = 'after';
    private const NAME = 'name';
    private const STATE = 'state';
    private const TASKS = 'tasks';
    private const CALLS = 'calls';
    private const PARENT = 'parent';
    private const ERROR_HANDLER = 'errorHandler';
    private const THROW_ERRORS = false;
    private const INVOKABLE_PROPERTIES = [
        self::NAME,
        self::STATE,
        self::TASKS,
        self::CALLS,
        self::PARENT,
        self::ERROR_HANDLER,
        self::THROW_ERRORS,
    ];

    private ?string $name = null;
    private array $state = [];
    private array $tasks = [];
    private array $calls = [];
    private mixed $parent = null;
    private mixed $errorHandler = null;
    private bool $throwErrors = true;
    private int $depth = 0;
    private string $outputPath = 'workflows/output';
    private array $output = [];

    use Newable;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function set(string|array $keyOrValues, mixed $value = null): static
    {
        $this->state = match (gettype($keyOrValues)) {
            'array' => [...$this->state, ...$keyOrValues],
            'string' => [...$this->state, ...[$keyOrValues => $value]],
        };

        return $this;
    }

    public function outputPath(string $outputPath): static
    {
        $this->outputPath = $outputPath;

        return $this;
    }

    private function message(string $message): string
    {
        // $standalone = empty($this->calls);

        // if ($standalone) {
        //     return "$message";
        // }

        $prompt = Str::of(Str::padRight($this->name, 12, '.'))->limit(12);

        $depth = '';

        if ($this->depth && $this->depth >= 0) {
            $depth = str_repeat('··', $this->depth) . '|';
        }

        $time = date('H:i:s');

        return "[{$time}] {$depth}$message";
        // return "[{$time} {$prompt}] {$depth}$message";
    }

    public function log(string|callable $message): static
    {
        return $this->addTask('', fn() => $this->LogInfo($this->message("~ $message")));
    }

    public function logInfo(string $message)
    {
        $this->output[] = $message;
    }

    public function logError(string $message)
    {
        $this->output[] = $message;
    }

    public function addTask(
        string $name,
        callable $task,
        bool|callable $when = true,
        callable $taskElse = null,
        $pool = self::POOL_DEFAULT
    ): static
    {
        $which = is_callable($when) ? $when($this) : $when;

        $task = $which ? $task : $taskElse;

        if ($task) {
            $this->tasks[$pool][] = (object) [
                'name' => $name,
                'run' => $task,
            ];
        }

        return $this;
    }

    public function before(string $name, callable $task, bool|callable $when = true, callable $taskElse = null): static
    {
        return $this->addTask($name, $task, $when, $taskElse, self::POOL_BEFORE);
    }

    public function after(string $name, callable $task, bool|callable $when = true, callable $taskElse = null): static
    {
        return $this->addTask($name, $task, $when, $taskElse, self::POOL_AFTER);
    }

    public function setErrorHandler(callable $errorHandler): static
    {
        $this->errorHandler = $errorHandler;

        return $this;
    }

    public function onError(\Exception $exception)
    {
        $errorMessage = 'Error running workflow - ' . $exception->getMessage()
            . ' - file: ' . $exception->getFile()
            . ' line: ' . $exception->getLine();

        $this->logError($errorMessage);

        if (is_callable($this->errorHandler)) {
            ($this->errorHandler)($exception);
        }

        if ($this->throwErrors) {
            throw new WorkflowException($errorMessage);
        }
    }

    public function run(): static
    {
        $allTasks = [
            ...$this->tasks[self::POOL_BEFORE] ?? [],
            ...$this->tasks[self::POOL_DEFAULT] ?? [],
            ...$this->tasks[self::POOL_AFTER] ?? [],
        ];

        if ($invokedBy = $this->parent()?->name()) {
            $invokedBy = " - from $invokedBy";
        }

        $this->logInfo($this->message("Workflow start {$this->name} $invokedBy"));

        $tasksCount = count(array_filter($allTasks, fn($task) => !empty($task->name)));

        $this->logInfo($this->message("Running $tasksCount tasks."));

        $no = 0;

        foreach ($allTasks as $task) {
            try {
                if (!empty($task->name)) {
                    $no++;
                    $this->logInfo($this->message("Task {$no}# {$task->name}."));
                }

                ($task->run)($this);
            } catch (\Exception $exception) {
                $this->onError($exception);
            }
        }

        $this->finish("Workflow finish {$this->name}");

        return $this;
    }

    public function call(Workflow $workflow, bool|callable $when = true, Workflow $workflowElse = null): static
    {
        $which = is_callable($when) ? $when($this) : $when;

        $child = $which ? $workflow : $workflowElse;

        if ($child) {
            $this->addTask('', function ($parent) use ($child) {
                $this->logInfo($this->message("Calling {$child->name()}"));
                $parent->depth++;
                $child->depth = $parent->depth;
                $parent->calls[] = "{$parent->name()} -> {$child->name()}";
                $child->set($parent->state());
                $child->parent = $parent;
                $child->run();
                $parent->depth--;
                $this->logInfo($this->message("Back from {$child->name()}"));
                $parent->set($child->state());
                $parent->calls = [...$parent->calls, ...$child->calls];
            });
        }

        return $this;
    }

    public function command(string $signature, bool|callable $when = true): static
    {
        $this->addTask(
            "Command $signature",
            fn($wf) => Artisan::call($signature),
            $when
        );

        return $this;
    }

    private function finish(?string $message = null): static
    {
        $this->logInfo($this->message($message));

        $path = $this->outputPath . '/' . Str::of($this->name)->kebab() . '.log';

        Storage::disk('logs')->put($path, implode(PHP_EOL, $this->output));

        return $this;
    }

    public function __set(string $name, mixed $value)
    {
        $this->state[$name] = $value;
    }

    public function __get(string $name)
    {
        $value = $this->state[$name] ?? null;

        if (is_null($value)) {
            throw new WorkflowException("Workflow property not set: $name");
        }

        return $value;
    }

    public function __call(mixed $name, mixed $args = []): mixed
    {
        if (in_array($name, self::INVOKABLE_PROPERTIES)) {
            return $this->{$name};
        }

        $found = $this->state[$name] ?? null;

        if (is_callable($found)) {
            return call_user_func_array($found, $args);
        }

        if (is_null($found)) {
            throw new WorkflowException("Workflow method doesn't exists: {$name}()");
        }

        return $found;
    }
}
