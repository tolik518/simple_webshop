<?php

namespace webShop;

class FrontProjector
{
    public function getHtml(array $productlist): string
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

        $productCards = '';
        /** @var $product Product */
        foreach($productlist as $product)
        {
            $productCard = $productcardHTML;
            $productCard = str_replace('%%PRODUCTID%%',        $product->getProductID(), $productCard);
            $productCard = str_replace('%%IMAGE%%',     $product->getProductImage(1), $productCard);
            $productCard = str_replace('%%PRODUCTNAME%%',      $product->getProductName(),      $productCard);
            $productCard = str_replace('%%PRODUCTSHORTDESC%%', ProductDesc::toHTML($product->getProductShortDesc()), $productCard);
            $productCards .= $productCard;
        }

        $html = str_replace('%%PRODUCTS%%', $productCards, $html);
        return $html;
    }
}