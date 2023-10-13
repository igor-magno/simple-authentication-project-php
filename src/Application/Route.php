<?php

namespace Src\Application;

class Route
{
    private static $routes;

    /**
     * @param string $uri
     * @param string $class
     * @param string $action
     * @param array $deps
     * @param array $middlewares
     * @return void
     */
    public static function get($uri, $class, $action, $deps = [], $middlewares = [])
    {
        self::$routes['get.' . $uri] = (object)[
            'class' => $class,
            'action' => $action,
            'deps' => $deps,
            'middlewares' => $middlewares
        ];
    }

    /**
     * @param string $uri
     * @param string $class
     * @param string $action
     * @param array $deps
     * @param array $middlewares
     * @return void
     */
    public static function post($uri, $class, $action, $deps = [], $middlewares = [])
    {
        self::$routes['post.' . $uri] = (object)[
            'class' => $class,
            'action' => $action,
            'deps' => $deps,
            'middlewares' => $middlewares
        ];
    }

    public static function run($req, $res)
    {
        $httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri)[0];
        $uri = str_replace('/' . $_ENV['APP_URL'], '', $uri);
        $route = self::$routes[$httpMethod . '.' . $uri] ?? null;
        if($route == null) return $res->view('404');
        foreach ($route->middlewares as $middleware) {
            $middleware->execute($req, $res);
        }
        $controller = new $route->class(...$route->deps);
        return $controller->{$route->action}($req, $res);
    }
}
