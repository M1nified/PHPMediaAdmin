<?php
require_once realpath('../../php/autoload.php');
require_once realpath('../../php/Data.php');
require_once realpath('../../php/GlobalVars.php');

function getDestination($tmp_name,$name){
    if($filename && sizeof($_FILES['files'])>1){
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$filename.'-'.$key;
    }elseif($filename){
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$filename;
    }else{
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$name;
    }
    $destination = Helper::pathNormalize($destination);
    return $destination;
}

header('Content-type: application/json');

$data = Data::getSingletonInstance();

print_r($_POST);
print_r(sizeof($_FILES));
print_r(sizeof($_POST));
parse_str($_POST,$data);
print_r($_FILES['files']);


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
    $name = $_FILES['files']['name'][$key];
    $destination = getDestination($tmp_name,$name);
    if(!move_uploaded_file($tmp_name,$destination)){
        throw new Exception("Error on move_uploaded_file", 201);
    }
    
}