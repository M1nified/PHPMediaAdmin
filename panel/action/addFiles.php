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


if(Post::contains('filename')){
    $filename = $_POST['filename'];
}else{
    $filename = null;
}
if(Post::contains('keywords')){
    $keywords = $_POST['keywords'];
}else{
    $keywords = null;
    die();
}

foreach ($_FILES['files']['error'] as $key => $error) {
    if($error != UPLOAD_ERR_OK){
        throw new Exception("Upload error ".$error, 202);
    }
    $tmp_name = $_FILES['files']['tmp_name'][$key];
    $name = $filename ? $filename : $_FILES['files']['name'][$key];
    $destination = getDestination($tmp_name,$name,sizeof($_FILES['files']['error']),$key);
    if(!move_uploaded_file($tmp_name,$destination)){
    // if(!copy($tmp_name,$destination)){
        throw new Exception("Error on move_uploaded_file", 201);
    }
    $data->conn->addFile($destination,$keywords);
}