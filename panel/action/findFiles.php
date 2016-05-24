<?php
ob_start();
require_once realpath('../../php/autoload.php');
require_once realpath('../../php/Data.php');
require_once realpath('../../php/GlobalVars.php');
ob_clean();

header('Content-type: application/json');

print_r($_GET);
print_r($_POST);

