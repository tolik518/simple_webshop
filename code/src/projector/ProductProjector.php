<?php

namespace webShop;

class ProductProjector
{
    public function getHtml(Product $product): string
    {
        $html = file_get_contents(HTML.'_index.html');
        $contentHTML = file_get_contents(HTML.'product/product.html');
        $newattribute = file_get_contents(HTML.'product/_attribute.html');
        $newattributesetting = file_get_contents(HTML.'product/_attributecontent.html');


        $contentHTML = str_replace('%%PRODUCTIMAGE%%',  $product->getProductImage(1), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTNAME%%',   $product->getProductName(), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDESC%%',   ProductDesc::toHTML($product->getProductDesc()), $contentHTML);
        $contentHTML = str_replace('%%PRODUCTDETAILS%%',ProductDetail::toHTML($product->getProductDetail()), $contentHTML);

        $configurator = '';

        //Für jedes attribut ein punkt
        /** @var Attribute $attribute */
        foreach ($product->getAttributes() as $attribute){
            $currentattribute = $newattribute;
            $currentattribute = str_replace('%%ATTRIBUTENAME%%'   ,  $attribute->getName(), $currentattribute);
            $currentattribute = str_replace('%%ATTRIBUTEDETAILS%%',  $attribute->getDescription(), $currentattribute);

            $setting = '';

            //für jede Auswahlmöglichkeit ein unterpunkt
            $attributesettings = $attribute->getPriceForValueArray();
            foreach ($attributesettings as $attributevalue => $attributeprice){
                $currentsetting = $newattributesetting;
                $currentsetting = str_replace('%%ATTRIBUTENAME%%' ,  $attribute->getName(), $currentsetting);
                $currentsetting = str_replace('%%ATTRIBUTEVALUE%%',  $attributevalue, $currentsetting);
                $currentsetting = str_replace('%%ATTRIBUTEPRICE%%',  $attributeprice, $currentsetting);

                //gucke das Attribut in der Standartconfig und setzte den
                if ($attributevalue == $attribute->getStandart()){
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