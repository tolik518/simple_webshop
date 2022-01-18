<?php

namespace webShop;

class CartProjector
{
    public function getHtml(array $productOrders): string
    {
        echo "<pre>";
        var_dump($productOrders);
        echo "</pre>";
        $html = file_get_contents(HTML.'_index.html');

        $contentHTML = file_get_contents(HTML.'cart/cart.html');
        $newcartitem = file_get_contents(HTML.'cart/_cartitem.html');

        $cartproducts = "";
        /** @var $productOrder ProductOrder */
        foreach ($productOrders as $productOrder){
            $cartproducts .= $newcartitem;
            $cartproducts = str_replace('%%CARTITEMS%%', "dings", $cartproducts);

            $configs = "";
            $newconfigpoint = file_get_contents(HTML.'cart/_configpoints.html');
            foreach ($productOrder->getAttributes() as $name => $value) {
                $configs .= $newconfigpoint;
                $configs = str_replace('%%ATTRIBUTENAME%%',  $name, $configs);
                $configs = str_replace('%%ATTRIBUTEVALUE%%', $value, $configs);
            }

            $cartproducts = str_replace('%%CONFIGPOINTS%%', $configs, $cartproducts);
        }

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