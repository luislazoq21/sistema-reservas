<?php

namespace App\Controllers;

class Controller
{
    protected function view(string $path, array $data = []): string
    {
        $baseDir = __DIR__ . '/../../resources/views/';

        $filePath = $baseDir . "{$path}.php";

        if (!file_exists($filePath)) {
            throw new \Exception("View file not found: " . $filePath);
        }

        extract($data);

        ob_start();

        require $filePath;

        return ob_get_clean();
    }
}
