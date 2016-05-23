<?php
/**
 *
 */
class Post
{

  // function __construct(argument){
  //   # code...
  // }
  public static function contains(){
    $names = func_get_args();
    foreach($names as $name){
      if(!is_scalar($_POST[$name]) || !isset($_POST[$name]) || empty($_POST[$name])){
        return false;
      }
    }
    return true;
  }
  public static function contains_detailed($messages = []){
    $name = func_get_args();
    $misses = [];
    foreach ($names as $name) {
      if(!is_scalar($_POST[$name]) || !isset($_POST[$name]) || empty($_POST[$name])){
        $misses[$name] = $messages[$name] || true;
      }
    }
    return $misses;
  }
  public static function xmlize(){
    $tree = [];
    foreach ($_POST as $key => $value) {
      $tree []= "<$key>$value</$key>";
    }
    $tree = implode("\r\n",$tree);
    return $tree;
  }
}
?>
