<?php
include_once "../base.php";

$news=$_POST['id'];
$chk=$Log->count(['news'=>$news,'acc'=>$_SESSION['login']]);
if ($chk>0) {
    $Log->del([
    'acc'=>$_SESSION['login'],
    'news'=>$news
    ]);
    $post=$News->find($news);
    $post['good']--;
    $News->save($post);
}else{
    $Log->save([
      'acc'=>$_SESSION['login'],
      'news'=>$news
  ]);
  $post=$News->find($news);
  $post['good']++;
  $News->save($post);
}
// $_POST['type'];
// $_POST['acc'];
// $_POST['news'];
// switch($_POST['type']){
//   case "1";
//   $Log->save([
//     'acc'=>$_POST['acc'],
//     'news'=>$_POST['id']
//   ]);
//   $news=$News->find($_POST['id']);
//   $news['good']++;
//   $News->save($news);
//   break;
//   case "2";
//   $Log->del([
//     'acc'=>$_POST['acc'],
//     'news'=>$_POST['id']
//     ]);
//     $news=$News->find($_POST['id']);
//     $news['good']--;
//     $News->save($news);
//   break;
// }
