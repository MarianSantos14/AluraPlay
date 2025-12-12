<?php

use DI\ContainerBuilder;
use League\Plates\Engine;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function() {
        $pdo = require __DIR__ . '/conexao.php';
        return $pdo;
    },
    Engine::class => function() {
        $templatePath = __DIR__ . '/../views';
        return new League\Plates\Engine($templatePath);
    }
]);

$container = $builder->build();

return $container;