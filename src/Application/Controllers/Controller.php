<?php

namespace Src\Application\Controllers;

use Throwable;
use Exception;
use Src\Application\Request;
use Src\Application\Response;

abstract class Controller
{
    protected function safeMode(string $errorRoute, Request $req, Response $res, callable $process)
    {
        try {
            return $process($req, $res);
        } catch (Exception $e) {
            return $res->redirect($errorRoute . '?error=' . $e->getCode() . ' - ' . $e->getMessage());
        } catch (Throwable $th) {
            return $res->redirect($errorRoute . '?error=Ocorreu um erro de nossa parte, por favor entre em contato com o suporte, [code:' . $th->getCode() . ' - message:' . $th->getMessage() . ' - file:' . $th->getFile() . ']');
        }
    }
}
