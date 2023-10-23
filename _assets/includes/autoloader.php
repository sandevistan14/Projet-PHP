<?php
    spl_autoload_register(function ($class) {
        $file = '/home/yuta/www/modules/' . str_replace(
                '\\',
                DIRECTORY_SEPARATOR,
                '\\' . strtolower($class)
                        ).'.php';
        //echo "1 include " . $file . "<br>";
        if (file_exists($file)) {
            include $file;
            return true;
        }
        else {
            $file2 = '/home/yuta/www/_assets/' . str_replace(
                    '\\',
                    DIRECTORY_SEPARATOR,
                    '\\' . $class
                ) . '.php';
            //echo "2 include " . $file2 . "<br>";
            if (file_exists($file2)) {
                include $file2;
                return true;
            }
        }
       include '/home/yuta/www/_assets/utils/class/User.php';
    });