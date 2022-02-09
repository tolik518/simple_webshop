<?php

namespace webShop;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

class AdminMiddleware implements MiddlewareInterface
{
    private SessionManager $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $adminContent = (string) $response->getBody();

        $response = new \Slim\Psr7\Response();

        if ($this->sessionManager->getRole() === ""){
            $response->getBody()->write("");
            return $response->withHeader('Location', '/login');
        }

        if($this->sessionManager->getRole() > 9000){
            $response->getBody()->write($adminContent);
        } else {
            $response->getBody()->write("Du hast nicht genügend Rechte um auf die Seite zugreifen zu können.");
        }

        return $response;
    }
}