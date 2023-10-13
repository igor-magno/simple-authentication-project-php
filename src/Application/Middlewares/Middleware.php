<?php

namespace Src\Application\Middlewares;

use Src\Application\Request;
use Src\Application\Response;

interface Middleware
{
    public function execute(Request $req, Response $res): void;
}
