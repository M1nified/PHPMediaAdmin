<?php


function linkNormal($link){
    $link = str_replace('\\','\/',$link);
    return $link;
}
function getGetfile(){
    $pma = "{$_SERVER['HTTP_HOST']}{$GLOBALS['PMA_CONFIG']['pma_dir']}";
    $pma = linkNormal($pma);
    return $pma;
}
function printGetfilePath(){
    echo getGetfile();
}