<?php
include_once "../base.php";


// $_POST['type'];
// $_POST['acc'];
// $_POST['news'];
switch($_POST['type']){
  case "1";
  $Log->save([
    'acc'=>$_POST['acc'],
    'news'=>$_POST['id']
  ]);
  break;
  case "2";
  $Log->del([
    'acc'=>$_POST['acc'],
    'news'=>$_POST['id']
  ]);
  break;
}
