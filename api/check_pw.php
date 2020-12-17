<?php
include_once "../base.php";


$acc=$_POST['acc'];
$acc=$_POST['pw'];

$chk=$Mem->count(['acc'=>$acc,'pw'=>$pw]);
if ($chk) {
  echo 1;
}else{
  echo 0;
}


?>