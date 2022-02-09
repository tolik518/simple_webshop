<?php

namespace webShop;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

class TranslationMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);

        if (isset($response->getHeader('Location')[0])) //keine weiterleitung
        {
            return $response;
        }

        $adminContent = (string)$response->getBody();
        $translations = json_decode(file_get_contents(TRANSLATION . 'de_br.json'));

        foreach ($translations as $key => $value) {
            $adminContent = str_replace("{" . $key . "}", "$value", $adminContent);
        }

        $response = new \Slim\Psr7\Response();
        $response->getBody()->write($adminContent);

        return $response;
    }
}