<?php
    spl_autoload_register(function ($class) {
        $file = '/home/yuta/www' . str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                '\\' . $class
                        ).'.php';
        //echo "include " . $file . "<br>";
        if (file_exists($file)) {
            include $file;
            return true;
        }
        return false;
    });
