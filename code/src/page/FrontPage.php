<?php

namespace webShop;

use JetBrains\PhpStorm\Pure;

class FrontPage
{
    public function __construct(
        private FrontProjector   $frontProjector,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductsAll(): string
    {
        return $this->frontProjector->getHtml();
    }
}