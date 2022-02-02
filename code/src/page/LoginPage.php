<?php

namespace webShop;


class LoginPage
{
    public function __construct(
        private LoginProjector   $adminLoginProjector,
        private MySQLLogin       $mySQLLogin,
        private SessionManager   $sessionManager,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getPage(): string
    {
        return $this->adminLoginProjector->getHtml();
    }

    public function login(): bool
    {
        $username = trim($this->variablesWrapper->getPostParam('username'));
        $password = $this->variablesWrapper->getPostParam('password');

        $loginSucessful = $this->mySQLLogin->login($username, $password);

        if($loginSucessful){
            $this->sessionManager->setUser($username, $this->mySQLLogin->getRole($username));
        }

        return $loginSucessful;
    }
}