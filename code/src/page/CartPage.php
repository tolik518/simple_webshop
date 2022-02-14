<?php

namespace webShop;

class CartPage
{
    public function __construct(
        private CartProjector      $cartProjector,
        private MySQLProductLoader $mySQLProductLoader,
        private SessionManager     $sessionManager,
        private VariablesWrapper   $variablesWrapper
    ){}

    public function getCart(): string
    {
        $productOrders = $this->sessionManager->getCart();

        if (!isset($productOrders) || count($productOrders) == 0)
        {
            return $this->cartProjector->getHtmlForEmpty();
        }
        //echo "<pre>";
        //var_dump($productOrders);

        /** @var $productOrder ProductOrder */
        foreach ($productOrders as $productOrder)
        {
            $products[] = $this->mySQLProductLoader->getProductByProductID($productOrder->getId());
        }

        $productOrders = array_values($productOrders);
        $products = array_values($products);

        $orderprices = PriceCalculator::calculatePrices($productOrders, $products);

        return $this->cartProjector->getHtml($productOrders, $products, $orderprices);
    }
}