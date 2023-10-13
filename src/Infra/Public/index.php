<?php

use Src\Application\Http;
use Src\Application\Route;

require __DIR__ . '/../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->safeLoad();

require __DIR__ . '/../Routes/web.php';

Http::cature(function ($req, $res) {
    return Route::run($req, $res);
});
