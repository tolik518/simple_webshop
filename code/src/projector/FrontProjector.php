<?php

namespace webShop;

class FrontProjector
{
    public function getHtml()
    {
        $html = file_get_contents(HTML.'frontpage.html');
        return $html;
    }
}