<?php
require 'autoload.php';
class Data {
    private static $singletonInstance;
    public $source;
    private function __construct(){
        auto_source();
    }
    public function getSingletonInstance(){
        if(!self::$singletonInstance){
            self::$singletonInstance = new self();
        }
        return self::$singletonInstance;
    }
    public function auto_source(){
        if($PMA_CONFIG['mysql_inuse'] == true){
            $source = new Sour_MySQL(
                $PMA_CONFIG['mysql_schema'],
                $PMA_CONFIG['mysql_location'].':'.$PMA_CONFIG['mysql_port'],
                $PMA_CONFIG['mysql_username'],$PMA_CONFIG['mysql_password']
            );
        }
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