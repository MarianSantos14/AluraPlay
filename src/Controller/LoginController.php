<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController implements Controller
{
    use FlashMessageTrait;

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = require __DIR__ . '/../../config/conexao.php';
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($queryParams['password']);

        $sql = 'SELECT * FROM users WHERE email = ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);
        $correctPassword = password_verify($password, $userData['password'] ?? '');

        if ($correctPassword) {
            $_SESSION['logado'] = true;
            return new Response(302, [
                'Locations' => '/'
            ]);
        } else {
            $this->addErrorMessage('Usuário ou senha inválidos');
            return new Response(302, [
                'Locations' => '/login'
            ]);
        }
    }
}
