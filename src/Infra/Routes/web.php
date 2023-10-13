<?php

use Src\Application\Route;
use Src\Application\Services\AuthService;
use Src\Application\Services\UserService;
use Src\Application\Controllers\AuthController;
use Src\Application\Controllers\HomeController;
use Src\Application\Controllers\UserController;
use Src\Application\Middlewares\AuthMiddleware;
use Src\Infra\Repositories\UserMySqlRepository;

Route::get('/auth/login', AuthController::class, 'loginPage', [new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::post('/auth/login', AuthController::class, 'login', [new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::get('/auth/logout', AuthController::class, 'logout', [new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);

Route::get('/user/register', UserController::class, 'registerPage', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::post('/user/register', UserController::class, 'register', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::get('/user/remove', UserController::class, 'remove', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);
Route::post('/user/delete', UserController::class, 'delete', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);
Route::get('/user/edit', UserController::class, 'edit', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);
Route::post('/user/update', UserController::class, 'update', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);
Route::get('/user/update-password', UserController::class, 'updatePasswordPage', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);
Route::post('/user/update-password', UserController::class, 'updatePassword', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))], [new AuthMiddleware]);

Route::get('/user/forgot-password-step-01', UserController::class, 'forgotPasswordStep01Page', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::post('/user/forgot-password-step-02', UserController::class, 'forgotPasswordStep02Page', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);
Route::post('/user/update-password-by-id', UserController::class, 'updatePasswordById', [new UserService(new UserMySqlRepository), new AuthService(new UserMySqlRepository, new UserService(new UserMySqlRepository))]);

Route::get('/home', HomeController::class, 'page', [new UserService(new UserMySqlRepository)], [new AuthMiddleware]);
