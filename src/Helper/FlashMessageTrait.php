<?php

declare(strict_types=1);

namespace Alura\Mvc\Helper;

trait FlashMessageTrait
{
    private function addErrorMenssage(string $errorMenssage): void {
        $_SESSION['error_menssage'] = $errorMenssage;
    }
}
