<?php

namespace webShop;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

class TranslationMiddleware implements MiddlewareInterface
{
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $lang = $request->getQueryParams()["lang"] ?? $this->sessionManager->getLang();
        $this->sessionManager->setLanguage($lang);  //TODO: gucken ob sprache existiert

        if ($this->isRedirect($response)){
            return $response; //wenn weiterleitung, dann gibts keinen body und nichts zum übersetzen
        }

        $htmlContent = $this->translatePage($response, $lang);

        $newresponse = new \Slim\Psr7\Response();
        $newresponse->getBody()->write($htmlContent);

        return $newresponse;
    }

    private function isRedirect(Response $response): bool
    {
        return isset($response->getHeader('Location')[0]);
    }

    private function translatePage(Response $response, $lang)
    {
        $htmlContent = (string)$response->getBody();
        $translations = json_decode(file_get_contents(TRANSLATION . $lang . '.json'));

        foreach ($translations as $key => $value) {
            $htmlContent = str_replace("{" . $key . "}", "$value", $htmlContent);
        }
        return $htmlContent;
    }
}