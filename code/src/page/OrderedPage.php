<?php

namespace webShop;

class OrderedPage
{
    public function __construct(
        private MySQLOrder $mySQLOrder,
        private MySQLProductLoader $mySQLProductLoader,
        private OrderedProjector $orderedProjector,
        private SessionManager $sessionManager,
        private VariablesWrapper $variablesWrapper
    ){}

    public function showPageAfterOrdered(): string
    {
        return $this->orderedProjector->getHtml();
    }

    public function processOrder(): void
    {
        try
        {
            $address = Adress::set(
                Email::fromString($this->variablesWrapper->getPostParam('email')),
                Name::fromString($this->variablesWrapper->getPostParam('firstname')),
                Name::fromString($this->variablesWrapper->getPostParam('lastname')),
                Street::fromString($this->variablesWrapper->getPostParam('street')),
                ZipCode::fromString($this->variablesWrapper->getPostParam('zipcode')),
                City::fromString($this->variablesWrapper->getPostParam('city')),
                State::fromString($this->variablesWrapper->getPostParam('state')),
                Country::fromString($this->variablesWrapper->getPostParam('country')),
                Phone::fromString($this->variablesWrapper->getPostParam('phone')),
                Company::fromString($this->variablesWrapper->getPostParam('company'))
            );
        }
        catch (\InvalidArgumentException $e)
        {
            $this->error = $e->getMessage();
        }

        $productOrders=$this->sessionManager->getCart();

        foreach ($productOrders as $productOrder)
        {
            $products[] = $this->mySQLProductLoader->getProductByProductID($productOrder->getId());
        }

        $productOrders = array_values($productOrders);
        $products = array_values($products);

        $price = PriceCalculator::calculatePriceForOrder($productOrders, $products);

        $this->mySQLOrder->makeOrder($address, $productOrders, $price);
    }
}