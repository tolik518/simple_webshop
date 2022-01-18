<?php

namespace webShop;

class CartPage
{
    public function __construct(
        private CartProjector    $cartProjector,
        private SessionManager   $sessionManager,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductsFromCart(): string
    {
        $productOrders[] = $this->sessionManager->getCart();
        $productOrders[] = $this->sessionManager->getCart(); //TODO: delete

        return $this->cartProjector->getHtml($productOrders);
    }
}