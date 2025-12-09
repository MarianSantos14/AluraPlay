<?php

use Alura\Mvc\Repository\VideoRepository;

require __DIR__ . '/src/config/conexao.php';

$id = $_GET['id'];

$repository = new VideoRepository($pdo);

if ($repository->remove($id) === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
