<?php
ob_start();
require_once realpath('../../php/autoload.php');
require_once realpath('../../php/Data.php');
require_once realpath('../../php/GlobalVars.php');
ob_clean();

header('Content-type: application/json');

// print_r($_GET);
// print_r($_POST);

function normalizeKeywords($kws){
    $kws = str_replace(","," ",$kws);
    // $kws = str_replace(" ","* ",$kws);
    $kws = str_replace('/  +/i',' ',$kws);
    return $kws;
}
if(Get::contains('keywords')){
    $keywords = normalizeKeywords($_GET['keywords']);
}else{
    $keywords = null;
}
if(Get::contains('since')){
    $since = parseDate($_GET['since']);
}else{
    $since = null;
}
if(Get::contains('until')){
    $until = parseDate($_GET['until']);
}else{
    $until = null;
}

$data = Data::getSingletonInstance();
$rows = $data->conn->findFile($keywords,$since,$until);
$json = json_encode($rows);
echo $json;