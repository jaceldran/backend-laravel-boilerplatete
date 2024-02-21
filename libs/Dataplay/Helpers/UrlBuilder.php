<?php

namespace Libs\Dataplay\Helpers;

use Libs\Dataplay\Traits\Newable;

class UrlBuilder
{
    use Newable;

    protected array $urlSegments;
    protected array $params;
    protected string $url;

    public function __construct(protected string $urlbase)
    {
        $this->urlbase = $urlbase;
    }

    public function addSegment(string $urlSegment): static
    {
        $this->urlSegments[trim($urlSegment)] = trim($urlSegment);

        return $this;
    }

    public function addParam(string $key, string $value): static
    {
        $this->params[trim($key)] = trim($value);

        return $this;
    }

    public function param(string $key): mixed
    {
        return $this->params[$key] ?? null;
    }

    public function build(?string $urlbase = null): string
    {
        $this->url = $urlbase ?? $this->urlbase;

        if (!empty($this->urlSegments)) {
            $this->url .= '/' . implode('/', array_values($this->urlSegments));
        }

        if (!empty($this->params)) {
            $this->url .= '?' . http_build_query($this->params);
        }

        return $this->url;
    }
}
