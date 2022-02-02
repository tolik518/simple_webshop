<?php

namespace webShop;

class MySQLLogin
{
    public function __construct(
        private \PDO $mySQLConnector
    ){}

    public function login(string $username, string $password): bool
    {
        $sql = $this->mySQLConnector->prepare(
          'SELECT *
                 FROM webshop.users
                 WHERE username = :username'
        );

        $sql->bindValue(':username', $username);
        $sql->execute();
        $result = $sql->fetch();

        if(!$result){
            return false; //unbekannter username
        }

        if(password_verify($password,$result['password'])){
            return true;  //richtiges passwort
        }
        //TODO: exceptions ausgeben bei falschem passwort?
        return false; //falsches passwort
    }

    public function getRole($username)
    {
        $sql = $this->mySQLConnector->prepare(
            'SELECT user_role 
                   FROM webshop.users
                   WHERE username = :username'
        );

        $sql->bindValue(':username', $username);
        $sql->execute();
        $result = $sql->fetch();

        return $result['user_role'];
    }
}