<?php

$PMA_CONFIG = parse_ini_file(join(DIRECTORY_SEPARATOR,array(dirname(__FILE__),"..","..","pma.ini")));

$required_fields = [
    "mysql_inuse",
    "mysql_location",
    "mysql_port",
    "mysql_username",
    "mysql_password",
    "mysql_schema",
    "mysql_table_prefix"
];

$failures = [];
foreach ($required_fields as $key => $value) {
    if(!array_key_exists($value,$PMA_CONFIG) || $PMA_CONFIG[$value] === NULL){
        $failures[] = $value;
    }
}
if(sizeof($failures)>0){
    throw new Exception("pma.ini failed to load all required params. Missing params are: "
    .join(' ,',$failures), 100);
}

print_r($PMA_CONFIG);