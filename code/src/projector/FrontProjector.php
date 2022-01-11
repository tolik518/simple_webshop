<?php

namespace webShop;

class FrontProjector
{
    public function getHtml(): string
    {
        $html       = file_get_contents(HTML.'frontpage.html');

        $headhtml   = file_get_contents(HTML.'_head.html');

        $footerhtml = file_get_contents(HTML.'_footer.html');
        $headerhtml = file_get_contents(HTML.'_header.html');

        $html = str_replace('%%HEAD%%', $headhtml, $html);

        $html = str_replace('%%FOOTER%%', $footerhtml, $html);
        $html = str_replace('%%HEADER%%', $headerhtml, $html);


        return $html;
    }
}