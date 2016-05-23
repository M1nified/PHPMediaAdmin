<?php
require realpath('../../php/autoload.php');
header('Content-type: text/plain');
print_r($_POST);
print_r(sizeof($_FILES));
print_r(sizeof($_POST));
parse_str($_POST,$data);
print_r($_FILES);
var_dump($_POST[0]);
var_dump($data);