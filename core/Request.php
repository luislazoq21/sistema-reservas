<?php

namespace Core;

class Request
{
    private string $method;
    private string $uri;
    private array $headers;
    private array $body;
    private array $queryParams;

    public function __construct()
    {
        $uri_cleaned = explode('?', $_SERVER['REQUEST_URI'])[0];

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = rtrim($uri_cleaned, '/') ?: '/';
        $this->headers = getallheaders();
        $this->body = json_decode(file_get_contents('php://input'), true) ?? [];
        $this->queryParams = $_GET;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }
}