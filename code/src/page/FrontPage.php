<?php

namespace webShop;

class FrontPage
{
    public function __construct(
        private FrontProjector   $frontProjector,
        private VariablesWrapper $variablesWrapper
    ){}

    public function getProductsAll()
    {
        return $this->frontProjector->getHtml();
    }
}