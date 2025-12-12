<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRenderTrait;

class LoginFormController implements Controller
{
    use HtmlRenderTrait;
    
    public function __construct() {}

    public function processaRequisicao(): void
    {
        if (($_SESSION['logado'] ?? false) === true) {
            header('Location: /');
        }

        echo $this->renderTemplate('login-form');
    }
}
