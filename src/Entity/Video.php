<?php

declare(strict_types=1);

namespace Alura\Mvc\Entity;

use finfo;
use InvalidArgumentException;

class Video
{
    public readonly int $id;
    public readonly string $url;
    public ?string $filePath = null;

    public function __construct(
        string $url,
        public readonly string $title,
    ) {
        $this->setUrl($url);
    }

    private function setUrl(string $url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) == false) {
            throw new InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function slugifyNomeDoArquivo(string $text): string
    {
        $text = mb_strtolower($text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        return trim($text, '-');
    }

    public function safeNameFile(): void
    {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $pathInfo = pathinfo($_FILES['image']['name']);

            $name = $pathInfo['filename'];
            $ext  = $pathInfo['extension'] ?? '';

            $name = $this->slugifyNomedoArquivo($name);

            $nome = $ext ? $name . '.' . strtolower($ext) : $name;

            $safeFileName = uniqid('upload_') . '_' . $nome;

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            if (str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $this->setFilePath($safeFileName);
            }
        }
    }
}
