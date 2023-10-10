<?php
    spl_autoload_register(function ($class) {
        $file = '/home/yuta/www/modules/' .str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                '\\' . strtolower($class)
                        ).'.php';
        //echo 'include ' . $file;
        require $file;
    });