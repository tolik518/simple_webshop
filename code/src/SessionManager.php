<?php
namespace webShop;


class SessionManager
{
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