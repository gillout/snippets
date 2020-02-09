<?php

class PhpHelper
{
    public static function debug($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
