<?php
require_once 'autoload.php';
// global $PMA_CONFIG;
print_r($PMA_CONFIG);
class Data {
    private static $singletonInstance;
    public $conn;
    private function __construct(){
        self::auto_conn();
    }
    public function getSingletonInstance(){
        if(!self::$singletonInstance){
            self::$singletonInstance = new self();
        }
        return self::$singletonInstance;
    }
    public function auto_conn(){
        if($GLOBALS['PMA_CONFIG']['mysql_inuse'] == true){
            $this->conn = new Sour_MySQL(
                $GLOBALS['PMA_CONFIG']['mysql_schema'],
                $GLOBALS['PMA_CONFIG']['mysql_location'].':'.$GLOBALS['PMA_CONFIG']['mysql_port'],
                $GLOBALS['PMA_CONFIG']['mysql_username'],$GLOBALS['PMA_CONFIG']['mysql_password']
            );
        }
    }
}

abstract class Source{
    abstract public function search($tip);
    abstract public function getFile($dir);
    abstract public function listFiles($dir);
    
    public function makeFileLocation($file_location){
        print($file_location);
        $path = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$file_location;
        $path = str_replace("/",DIRECTORY_SEPARATOR,$path);
        $path = str_replace("\\",DIRECTORY_SEPARATOR,$path);
        $regex = '/\\'.DIRECTORY_SEPARATOR.'\\'.DIRECTORY_SEPARATOR.'+/i';
        var_dump($regex);
        $path = preg_replace($regex,DIRECTORY_SEPARATOR,$path);
        var_dump($path);
        //$path = realpath($path);
        return $path;
    }
    public function makeKeywords($keywords){
        return $keywords;
    }
}

class Sour_MySQL extends Source{
    private $db;
    public function __construct($dbname,$server,$username,$password,$charset='utf8'){
        $this->db = new medoo([
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
    
    public function getTab($tabname){
        return $GLOBALS['PMA_CONFIG']['mysql_table_prefix'].$tabname;
    }
    
    public function addFile($file_location,$keywords,$file){
        $fl = self::makeFileLocation($file_location);
        print($fl);
        $kw = self::makeKeywords($keywords);
        $this->db->insert(self::getTab('file'),[
            'file_location' => $fl, 'keywords' => $kw
        ]);
    }
    public function deleteFile($id){
        $this->db->delete(self::getTab('file'),[
            "AND"=>[
                "id" => $id
            ]
        ]);
    }
}