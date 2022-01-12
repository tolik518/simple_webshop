<?php

namespace webShop;

class FrontProjector
{
    public function getHtml($products = [0,0,0,0,0,0,0,0,0,0,0]): string
    {
        $html = file_get_contents(HTML.'_index.html');
        $contentHTML = file_get_contents(HTML.'productoverview/productoverview.html');
        $productcardHTML = file_get_contents(HTML.'productoverview/_productcard.html');

        $headHTML   = file_get_contents(HTML.'_head.html');

        $footerHTML = file_get_contents(HTML.'_footer.html');
        $headerHTML = file_get_contents(HTML.'_header.html');

        $html = str_replace('%%HEAD%%', $headHTML, $html);

        $html = str_replace('%%HEADER%%', $headerHTML, $html);
        $html = str_replace('%%CONTENT%%', $contentHTML, $html);
        $html = str_replace('%%FOOTER%%', $footerHTML, $html);

        $productsHTML = "";
        foreach($products as $product)
        {
            $productsHTML .= $productcardHTML;
        }

        $html = str_replace('%%PRODUCTS%%', $productsHTML, $html);

        return $html;
    }
}