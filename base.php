<?php
date_default_timezone_set("Asia/Taipei");
session_start();
$Total = new DB('total');
$Mem=new DB("member");
$News=new DB("news");
$Log=new DB('log');
$Que=new DB('que');


$typeStr=[
  1=>"健康新知",
  2=>"菸害防治",
  3=>"癌症防治",
  4=>"慢性病防治"
];

// 判斷增加瀏覽人數
if (empty($_SESSION['total'])) {
  if ($Total->count(['date' => date("Y-m-d")]) > 0) {
    $total = $Total->find(['date' => date("Y-m-d")]);
    $total['total']++;
    $Total->save($total);
    $_SESSION['total'] = $total['total'];
  } else {
    $total = ['date' => date("Y-m-d"), 'total' => 1];
    $Total->save($total);
  }
  $_SESSION['total'] = $total['total'];
}
class DB
{
  protected $table;
  protected $dsn = "mysql:host=localhost;dbname=db22;charset=utf8";
  protected $pdo;

  function __construct($table)
  {
    $this->table = $table;
    $this->pdo = new PDO($this->dsn, 'root', '');
  }
  function all(...$arg)
  {
    $sql = "select * from $this->table";
    if (isset($arg[0])) {
      if (is_array($arg[0])) {
        foreach ($arg[0] as $key => $value) {
          $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql .= " where " . implode("&&", $tmp);
      } else {
        $sql .= $arg[0];
      }
    }
    if (isset($arg[1])) {
      $sql .= $arg[1];
    }
    return $this->pdo->query($sql)->fetchAll();
  }
  function count(...$arg)
  {
    $sql = "select count(*) from $this->table ";

    if (isset($arg[0])) {
      if (is_array($arg[0])) {
        foreach ($arg[0] as $key => $value) {
          $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }

        $sql .= " where " . implode(" && ", $tmp);
      } else {
        $sql .= $arg[0];
      }
    }

    if (isset($arg[1])) {
      $sql .= $arg[1];
    }

    return $this->pdo->query($sql)->fetchColumn();
  }
  function find($id)
  {
    $sql = "select * from $this->table ";
    if (is_array($id)) {
      foreach ($id as $key => $value) {
        $tmp[] = sprintf("`%s`='%s'", $key, $value);
      }
      $sql .= " where " . implode(" && ", $tmp);
    } else {
      $sql .= " where `id`='$id'";
    }
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }

  function del($id)
  {
    $sql = "delete from $this->table ";

    if (is_array($id)) {
      foreach ($id as $key => $value) {
        $tmp[] = sprintf("`%s`='%s'", $key, $value);
      }
      $sql .=" where " .implode("&&", $tmp);
    } else {
      $sql .= " where `id`='{$id}'";
    }

    return $this->pdo->exec($sql);
  }
  function save($arr)
  {
    if (isset($arr['id'])) {
      foreach ($arr as $key => $value) {
        $tmp[] = sprintf("`%s`='%s'", $key, $value);
      }
      $sql = "update $this->table set " . implode(',', $tmp) . " where `id`='{$arr['id']}'";
    } else {
      $sql = "insert into $this->table (`" . implode("`,`", array_keys($arr)) . "`) values('" . implode("','", $arr) . "')";
    }

    return $this->pdo->exec($sql);
  }

  function q($sql)
  {
    return $this->pdo->query($sql)->fetchAll();
  }

}
function to($url)
{
  header("location:" . $url);
}
