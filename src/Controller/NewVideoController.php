<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use finfo;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository) {}

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            $_SESSION['error_menssage'] = 'Url inválida ou não informada';
            header('Location: /novo-video');
            return;
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            $_SESSION['error_menssage'] = 'Título não informado';
            header('Location: /novo-video');
            return;
        }

        $video = new Video($url, $titulo);

        $video->safeNameFile();

        $success = $this->videoRepository->add($video);
        if ($success === false) {
            $_SESSION['error_menssage'] = 'Erro ao cadastrar vídeo';
            header('Location: /novo-video');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
