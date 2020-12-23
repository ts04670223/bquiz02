<?php

class DB{
  protected $table;
  protected $dsn="mysql:host=localhost;dbname=dsfs;charset=utf8";
  protected $pdo;

  function __construct($table)
  {
    $this->table = $table;
    $this->pdo=new PDO($this->dsn,'root','');
  }

  function all(...$arg){
    $sql="select * from $this->table ";
    if (isset($arg[0])) {
      if (is_array($arg[0])) {
        foreach($arg[0] as $key=>$value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql .=" where ".implode(" && ",$tmp);
      }else{
        $sql .=$arg[0];
      }
    }
    if (isset($arg[1])) {
      $sql .=$arg[1];
    }
    return $this->pdo->query($sql)->fetchAll();
  }
  function count(...$arg){
    $sql="select (*) from $this->table ";
    if (isset($arg[0])) {
      if (is_array($arg[0])) {
        foreach($arg[0] as $key=>$value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql .=" where ".implode(" && ",$tmp);
      }else{
        $sql .=$arg[0];
      }
    }
    if (isset($arg[1])) {
      $sql .=$arg[1];
    }
    return $this->pdo->query($sql)->fetchColumn();
  }
  function find($id){
    $sql="select * from $this->table ";
      if (is_array($id)) {
        foreach($id as $key=>$value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql .=" where ".implode(" && ",$tmp);
      }else{
        $sql .=" where `id`='{$id}'";
      }
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
  function del($id){
    $sql="delete from $this->table ";
      if (is_array($id)) {
        foreach($id as $key=>$value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql .=" where ".implode(" && ",$tmp);
      }else{
        $sql .=" where `id`='{$id}'";
      }
    return $this->pdo->exec($sql);
  }
}

?>