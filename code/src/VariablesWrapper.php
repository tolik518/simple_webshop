<?php
namespace webShop;

class VariablesWrapper
{
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function isPost(): bool
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            return true;
        }
        return false;
    }

    public function getPostParam($param)
    {
        if(!empty($_POST[$param]))
        {
            return $_POST[$param];
        }
        return null;
    }

    public function getFile($param)
    {
        if(!empty($_FILES[$param]))
        {
            return $_FILES[$param];
        }
        return null;
    }

    public function getSendPostParamCount(): int
    {
        if(!empty($_POST))
        {
            return count($_POST);
        }
        return 0;
    }
}