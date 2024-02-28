<?php

namespace App\Console\Commands;

trait WithOutput
{
    public function output(string $message): void
    {
        echo $message . PHP_EOL;
    }
}
