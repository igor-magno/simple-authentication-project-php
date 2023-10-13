<?php

namespace Src\Application;

class Response
{
    public function __construct(
        private mixed $body = '',
        private string | null $redirect = null
    ) {
    }

    public function view(string $path, array $deps = [])
    {
        extract($deps);
        ob_start();
        require __DIR__ . '/Views/' . str_replace('.', '/', $path) . '.php';
        $this->body = ob_get_clean();
        return $this;
    }

    public function json(mixed $body)
    {
        $this->body = json_encode($body);
        header('Content-Type: application/json');
        return $this;
    }

    public function redirect(string $route)
    {
        $this->redirect = $_ENV['APP_URL'] . $route;
        return $this;
    }

    public function send()
    {
        if($this->redirect != null)
        {
            header('Location: ' . $this->redirect);
            die();
        }
        die($this->body);
    }

    public static function redirectForce(string $route)
    {
        header('Location: ' . $_ENV['APP_URL'] . $route);
        die();
    }
}
