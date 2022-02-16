<?php
namespace webShop;


class SessionManager
{
    public  function isLoggedIn(): bool
    {
        return isset($_SESSION['name'], $_SESSION['role']);
    }

    public function setCurrency($currency): void
    {
        $_SESSION['currency'] = $currency;

        $arr_cookie_options = array (
            'expires' => time() + 60*60*24*30,
            'path' => '/',
            'domain' => '127.0.0.1', // leading dot for compatibility or use subdomain
            'secure' => false,     // or false
            'httponly' => false,    // or false
            'samesite' => 'None' // None || Lax  || Strict
        );
        setcookie("currency", $currency);
    }

    public function getCurrency(): string
    {
        return $_SESSION['currency'] ?? "EUR";
    }

    public function setLanguage($lang): void
    {
        $_SESSION['lang'] = $lang;
    }

    public function getLang(): string
    {
        return $_SESSION['lang'] ?? "en";
    }

    public function setUser($name, $role): void
    {
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
    }

    public function getName(): string
    {
        return $_SESSION['name'] ?? "";
    }

    public function getRole(): string
    {
        return $_SESSION['role'] ?? "";
    }

    public function logout()
    {
        unset($_SESSION['role']);
        unset($_SESSION['name']);
    }

    public function addToCart(ProductOrder $productOrder): void
    {
        $_SESSION['cart'][$productOrder->getHash()] = $productOrder;
    }

    public function getCart(): array
    {
        return $_SESSION['cart'] ?? [];
    }

    public function deleteItemFromCart($hash): void
    {
        unset($_SESSION["cart"][$hash]);
    }

    public function deleteCart(): void
    {
        $_SESSION['cart'] = [];
    }

}