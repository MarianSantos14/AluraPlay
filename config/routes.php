<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    DeleteVideoController,
    EditVideoController,
    LoginFormController,
    NewVideoController,
    VideoFormController,
    VideoListController,
    LoginController
};

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NewVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class
];