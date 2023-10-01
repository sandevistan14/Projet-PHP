<?php
    spl_autoload_register(function ($class) {
        $file = 'modules' .str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                '\\' . strtolower($class)
                        ).'.php';

        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    });
