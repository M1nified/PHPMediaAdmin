<?php
header('Content-type: text/plain');
require '../php/Data.php';

$data = Data::getSingletonInstance();
print_r($data);

$data->conn->deleteFile(6);
$data->conn->addFile("/cos/innego.png","plik testowy pierwszy",null);

var_dump(Source::makeFileLocation("/cos/innego.png"));