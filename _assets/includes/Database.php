<?php
namespace _assets\includes;
class Database
{
    private $PDOInstance = null;
    private static $instance = null;

    const DB_HOST = 'mysql-yuta.alwaysdata.net';
    const DB_NAME = 'yuta_database';
    const DB_USER = 'yuta_user';
    const DB_PWD = 'useMAN!';
    private function __construct()
    {
        $this->PDOInstance = new \PDO('mysql:host='.self::DB_HOST.";dbname=".self::DB_NAME,self::DB_USER,self::DB_PWD);
    }

    public static function getInstance() {
        if(is_null(self::$instance))
            self::$instance = new Database();
        return self::$instance;
    }

    public function __call($method, $params) {
        if($this->PDOInstance == NULL) {
            self::__construct();
        }
        return call_user_func_array(array($this->PDOInstance, $method), $params);
    }
}