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
if(Post::contains('files')){
    $files = explode(";",$_POST['files']);
    $files = array_map(function($file){
        return trim($file);
    },$files);
}else{
    $files = null;
    die();
}
// var_dump($_SERVER['DOCUMENT_ROOT']);
foreach ($files as $key => $error) {
    if($error != UPLOAD_ERR_OK){
        throw new Exception("Link error ".$error, 202);
    }
    if(!($file_location = realpath($_SERVER['DOCUMENT_ROOT'].'/'.$files[$key]))){
        throw new Exception("No such file as \'".$files[$key].'\'',203);
    }
    $data->conn->addFile($file_location,$keywords);
}
print(json_encode(["result"=>true]));