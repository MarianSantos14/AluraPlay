<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

class LoginFormController extends ControllerWithHtml implements Controller
{
    public function __construct() {}

    public function processaRequisicao(): void
    {
        if (($_SESSION['logado'] ?? false) === true) {
            header('Location: /');
        }

        echo $this->renderTemplate('login-form');
    }
}
