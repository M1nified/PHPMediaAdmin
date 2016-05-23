<?php
require realpath('../../php/autoload.php');
header('Content-type: text/plain');

print_r($_POST);
print_r(sizeof($_FILES));
print_r(sizeof($_POST));
parse_str($_POST,$data);
print_r($_FILES['files']);
foreach ($_FILES['files']['error'] as $key => $value) {
    $tmp_name = $_FILES['files']['tmp_name'][$key];
    $name = $_FILES['files']['name'][$key];
    move_uploaded_file($tmp_name,$destination);
}