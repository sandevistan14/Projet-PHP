<?php
    spl_autoload_register(function ($class) {
        $file = 'modules' .str_replace('\\', DIRECTORY_SEPARATOR, '\\' . strtolower($class)).'.php';
        //echo $file;
        if (file_exists($file)) {
            //echo 'oui';
            require $file;
            return true;
        }
        return false;

    });
