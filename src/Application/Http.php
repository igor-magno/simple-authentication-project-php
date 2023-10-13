<?php

namespace Src\Application;

class Http
{
    public static function cature(callable $process)
    {
        $request = new Request();
        $response = new Response();
        $response = $process($request, $response);
        $response->send();
    }
}
