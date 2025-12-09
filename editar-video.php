<?php

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

require __DIR__ . '/src/config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    header('Location: /?sucesso=0');
    exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

$video = new Video($url, $titulo);
$video->setID($id);

$repository = new VideoRepository($pdo);
$repository->update($video);

if ($repository->update($video) === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}
