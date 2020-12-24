<?php
include_once "../base.php";

$type=$_GET['type'];

$news=$News->all(['type'=>$type]);
$result=[];
// $result=array_column($news,'','');
foreach($news as $n){
  $result[]=[
    'title'=>$n['title'],
    'id'=>$n['id']
  ];
}
echo json_encode($result);
// foreach($news as $n){
//   echo "<a href='javascript:getNews({$n['id']})'style='display:block'>{$n{'title'}}</a>";
// }


?>
