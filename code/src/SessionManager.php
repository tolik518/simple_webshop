<?php
namespace webShop;
session_start();

class SessionManager
{
    public function setAuthenticatedUser($username, $userrole): void
    {
        $_SESSION['username'] = $username;
        $_SESSION['role']     = $userrole;
        if(!headers_sent()){
            header("refresh:0;url=/admin");
        } else {
            echo "Bitte laden Sie die Seite neu";
        }
    }

    public function addToCart(ProductOrder $productOrder): void
    {
        $_SESSION['cart'] = $productOrder;
    }

    public function getCart()
    {
        return $_SESSION['cart'];
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['username']);
    }

    public function getAuthenticatedUsername(): string
    {
        return $_SESSION['username'];
    }

    public function getAuthenticatedUserrole(): string
    {
        return $_SESSION['role'];
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        setcookie('PHPSESSID',"",time()-3600,'/'); // old session will be overwritten in the cookie
        /*
        if(!headers_sent())
        {
            header("Refresh:0");
            return 0;
        }
        echo "Bitte laden Sie die Seite neu";*/
    }
}