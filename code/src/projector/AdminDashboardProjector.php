<?php

namespace webShop;

class AdminDashboardProjector
{
    public function getHtml(): string
    {
        $html = file_get_contents(HTML.'_index.html');
        $contentHTML = "Admin Dashboard";

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