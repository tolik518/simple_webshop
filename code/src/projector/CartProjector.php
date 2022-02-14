<?php

namespace webShop;

class CartProjector
{
    /** @var $productOrders ProductOrder[]
     *  @var $products Product[]
     *  @var $prices array
     */
    public function getHtml(array $productOrders, array $products, array $prices): string
    {
        $html = file_get_contents(HTML.'_index.html');

        $contentHTML = file_get_contents(HTML.'cart/cart.html');
        $newcartitem = file_get_contents(HTML.'cart/_cartitem.html');

        $cartproducts = "";

        foreach ($productOrders as $index => $productOrder)
        {
            $cartproducts .= $newcartitem;

            $cartproducts = str_replace('%%ITEMPRICE%%', $prices[$index], $cartproducts);
            $cartproducts = str_replace('%%PRODUCTNAME%%', $products[$index]->getProductName(), $cartproducts);
            $cartproducts = str_replace('%%PRODUCTIMAGE%%', $products[$index]->getProductImage(1), $cartproducts);
            $cartproducts = str_replace('%%PRODUCTID%%', $productOrder->getHash(), $cartproducts);

            $configs = "";
            $newconfigpoint = file_get_contents(HTML.'cart/_configpoints.html');
            foreach ($productOrder->getAttributes() as $name => $value)
            {
                $configs .= $newconfigpoint;
                $configs = str_replace('%%ATTRIBUTENAME%%',  $name, $configs);
                $configs = str_replace('%%ATTRIBUTEVALUE%%', $value, $configs);
            }

            $cartproducts = str_replace('%%CONFIGPOINTS%%', $configs, $cartproducts);
        }

        $contentHTML = str_replace('%%CARTITEMS%%', $cartproducts, $contentHTML);

        $totalprice = 0;
        foreach ($prices as $price)
        {
            $totalprice+=$price;
        }
        $totalpriceaftertax = round($totalprice+($totalprice/100*19), 2);
        //TODO: Quick hack -> Preisberechnung auslagern!
        $contentHTML = str_replace('%%TOTALPRICE%%', $totalprice, $contentHTML);

        $headHTML   = file_get_contents(HTML.'_head.html');
        $footerHTML = file_get_contents(HTML.'_footer.html');
        $headerHTML = file_get_contents(HTML.'_header.html');

        $html = str_replace('%%HEAD%%', $headHTML, $html);

        $html = str_replace('%%HEADER%%', $headerHTML, $html);
        $html = str_replace('%%CONTENT%%', $contentHTML, $html);
        $html = str_replace('%%FOOTER%%', $footerHTML, $html);

        return $html;
    }

    public function getHtmlForEmpty()
    {
        $html = file_get_contents(HTML.'_index.html');

        $contentHTML = file_get_contents(HTML.'cart/cart.html');
        $newcartitem = file_get_contents(HTML.'cart/_cartitem.html');

        $cartproducts = '<div class="cartItem">{empty_cart_lang}</div>';
        $contentHTML = str_replace('%%TOTALPRICE%%', "", $contentHTML);
        $contentHTML = str_replace('%%CARTITEMS%%', $cartproducts, $contentHTML);

        $headHTML   = file_get_contents(HTML.'_head.html');

        $footerHTML = file_get_contents(HTML.'_footer.html');
        $headerHTML = file_get_contents(HTML.'_header.html');

        $html = str_replace('%%HEAD%%', $headHTML, $html);

        $html = str_replace('%%HEADER%%', $headerHTML, $html);
        $html = str_replace('%%CONTENT%%', $contentHTML, $html);
        $html = str_replace('%%FOOTER%%', $footerHTML, $html);

        return $html;
    }
}