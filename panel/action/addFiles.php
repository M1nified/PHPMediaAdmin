<?php
require realpath('../../php/autoload.php');
require realpath('../../php/GlobalVars.php');
header('Content-type: text/plain');

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

foreach ($_FILES['files']['error'] as $key => $value) {
    $tmp_name = $_FILES['files']['tmp_name'][$key];
    $name = $_FILES['files']['name'][$key];
    if($filename && sizeof($_FILES['files'])>1){
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$filename.'-'.$key;
    }elseif($filename){
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$filename;
    }else{
        $destination = $GLOBALS['PMA_CONFIG']['files_location'].DIRECTORY_SEPARATOR.$name;
    }
    move_uploaded_file($tmp_name,$destination);
}