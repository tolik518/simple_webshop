<?php

namespace webShop;

class ProductProjector
{
    public function getHtml(Product $product, array $attributes, array $standartconfig): string
    {
        $html = file_get_contents(HTML.'_index.html');
        $contentHTML = file_get_contents(HTML.'product/product.html');
        $newattribute = file_get_contents(HTML.'product/_attribute.html');
        $newattributesetting = file_get_contents(HTML.'product/_attributecontent.html');


        $contentHTML = str_replace('%%PRODUCTIMAGE%%',  $product->getProductImage(1), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTNAME%%',    $product->getProductName(), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDESC%%',    ProductDesc::toHTML($product->getProductDesc()), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDETAILS%%', ProductDetail::toHTML($product->getProductDetail()), $contentHTML);

        $configurator = '';

        //Für jedes attribut ein punkt
        foreach ($attributes as $attribute){
            $currentattribute = $newattribute;
            $currentattribute = str_replace('%%ATTRIBUTENAME%%'   ,  $attribute[0]['name'], $currentattribute);
            $currentattribute = str_replace('%%ATTRIBUTEDETAILS%%',  $attribute[0]['description'],$currentattribute);

            $setting = '';

            //für jede Auswahlmöglichkeit ein unterpunkt
            foreach ($attribute as $attributesetting){
                $currentsetting = $newattributesetting;
                $currentsetting = str_replace('%%ATTRIBUTENAME%%'    ,  $attributesetting['name'], $currentsetting);
                $currentsetting = str_replace('%%ATTRIBUTEVALUE%%'   ,  $attributesetting['value'], $currentsetting);

                //gucke das Attribut in der Standartconfig und setzte den
                if ($standartconfig[$attributesetting['name']] == $attributesetting['value']){
                    $currentsetting = str_replace('%%ATTRIBUTESELECTED%%',  "checked", $currentsetting);
                }
                $currentsetting = str_replace('%%ATTRIBUTESELECTED%%',  "", $currentsetting);

                $setting .= $currentsetting;
            }

            $currentattribute = str_replace('%%ATTRIBUTECONTENT%%', $setting, $currentattribute);

            $configurator .= $currentattribute;
        }
        $contentHTML = str_replace('%%CONFIGURATOR%%', $configurator, $contentHTML);

        $headHTML   = file_get_contents(HTML.'_head.html');
        $footerHTML = file_get_contents(HTML.'_footer.html');
        $headerHTML = file_get_contents(HTML.'_header.html');

        $html = str_replace('%%HEAD%%',    $headHTML,    $html);
        $html = str_replace('%%HEADER%%',  $headerHTML,  $html);
        $html = str_replace('%%CONTENT%%', $contentHTML, $html);
        $html = str_replace('%%FOOTER%%',  $footerHTML,  $html);

        return $html;
    }
}