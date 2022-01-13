<?php

namespace webShop;

class ProductProjector
{
    public function getHtml(Product $product): string
    {
        $html = file_get_contents(HTML.'_index.html');
        $contentHTML = file_get_contents(HTML.'product/product.html');

        $contentHTML = str_replace('%%PRODUCTIMAGE%%', $product->getProductImage(1), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTNAME%%', $product->getProductName(), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDESC%%', ProductDesc::toHTML($product->getProductDesc()), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDETAILS%%', ProductDetail::toHTML($product->getProductDetail()), $contentHTML);


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