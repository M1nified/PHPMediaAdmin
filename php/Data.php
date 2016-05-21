<?php
require 'autoload.php';
class Data {
    private static $singletonInstance;
    private function __construct(){
        
    }
    public function getSingletonInstance(){
        if(!self::$singletonInstance){
            self::$singletonInstance = new self();
        }
        return self::$singletonInstance;
    }
}

abstract class Source{
    abstract public function search($tip);
    abstract public function getFile($dir);
    abstract public function listFiles($dir);
}

class Sour_MySQL extends Source{
    private $db;
    public function __construct($dbname,$server,$username,$password,$charset='utf8'){
        $db = new medoo([
            'database_type' => 'mysql',
            'database_name' => $dbname,
            'server' => $server,
            'username' => $username,
            'password' => $password,
            'charset' => $charset
        ]);
    }
    public function search($tip){
        
    }
    public function getFile($dir){
        
    }
    public function listFiles($dir){
        
    }
}