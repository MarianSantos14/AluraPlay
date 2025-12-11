<?php

declare(strict_types=1);

use Alura\Mvc\Controller\{
    DeleteCapaController,
    DeleteVideoController,
    EditVideoController,
    JsonVideoListController,
    LoginFormController,
    NewVideoController,
    VideoFormController,
    VideoListController,
    LoginController,
    LogoutController,
    NewJsonVideoController
};

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NewVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,
    'GET|/login' => LoginFormController::class,
    'POST|/login' => LoginController::class,
    'GET|/logout' => LogoutController::class,
    'GET|/delete-capa' => DeleteCapaController::class,
    'GET|/video-json' => JsonVideoListController::class,
    'POST|/videos' => NewJsonVideoController::class,
];