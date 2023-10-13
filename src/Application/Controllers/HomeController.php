<?php

namespace Src\Application\Controllers;

use Src\Application\Request;
use Src\Application\Response;
use Src\Domain\Entities\Auth;
use Src\Application\Services\UserService;
use Src\Application\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(
        private UserService $service
    ) {
    }

    public function page(Request $req, Response $res)
    {
        return $this->safeMode('/auth/login', $req, $res, function ($req, $res) {

            return $res->view('home', ['user' => Auth::user()]);
        });
    }
}
