<?php
ob_start();
require_once realpath('../../php/autoload.php');
require_once realpath('../../php/Data.php');
require_once realpath('../../php/GlobalVars.php');
ob_clean();

header('Content-type: application/json');

function getDestination($tmp_name,$name,$len,$key){
    if($name && $len>1){
        $destination = $GLOBALS['PMA_CONFIG']['files_dir'].'/'.$name.'-'.$key;
    }elseif($name){
        $destination = $GLOBALS['PMA_CONFIG']['files_dir'].'/'.$name;
    }else{
        $destination = $GLOBALS['PMA_CONFIG']['files_dir'].'/'.$name;
    }
    $destination = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
    $destination = Helper::pathNormalize($destination);
    return $destination;
}

$data = Data::getSingletonInstance();

// print_r($_POST);
// parse_str($_POST,$data);
// print_r($_FILES['files']);


if(Post::contains('keywords')){
    $keywords = $_POST['keywords'];
}else{
    $keywords = null;
    die();
}
if(Post::contains('url')){
    $url = $_POST['url'];
    if(preg_match('/:\/\//',$url) == 1){
        //normal link - ok
    }else{
        //wrong url string
        $url = 'http://'.$url;
    }
}else{
    $url = null;
    die();
}
$data->conn->addUrl($url,$keywords);
print(json_encode(["result"=>true]));