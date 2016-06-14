<?php
require_once 'autoload.php';
require_once 'GlobalVars.php';
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
        $path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$file_location);
        $path = Helper::pathNormalize($path);
        //$path = realpath($path);
        return $path;
    }
    public function makeKeywords($keywords){
        return $keywords;
    }
    public function makeMask($file_location){
        $mask = md5($file_location.uniqid());
        return $mask;
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
    
    public function addFile($file_location,$keywords){
        $fl = self::makeFileLocation($file_location);
        // print($fl);
        $kw = self::makeKeywords($keywords);
        $mask = self::makeMask($fl);
        $this->db->insert(self::getTab('file'),[
            'file_location' => $fl, 'keywords' => $kw, 'mask' => $mask
        ]);
    }
    public function deleteFile($id){
        $this->db->delete(self::getTab('file'),[
            "AND"=>[
                "id" => $id
            ]
        ]);
    }
    public function findFile($keywords,$since,$until){
        $filecols = [
            'id',
            'file_location',
            'keywords',
            'creation_date',
            'mask'
        ];
        $records = [];
        if($keywords && !$since && !$until){
            $records = $this->db->select(self::getTab('file'),$filecols,[
                "MATCH" => [
                    "columns" => ["file_location","keywords"],
                    "keyword" => $keywords
                ]
            ]);
        }
        return $records;
    }
}