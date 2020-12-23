<fieldset>
<legend>目前位置 : 首頁 > 問卷調查</legend>
<table>
    <tr>
      <th width="10%">編號</th>
      <th>問卷題目</th>
      <th width="10%">投票總數</th>
      <th width="10%">結果</th>
      <th width="10%">狀態</th>
    </tr>
    <?php
        $all = $Que->all(['subject'=>0]);
        foreach ($all as $key => $qul) {
    ?>
    <tr>
      <td ><?=$key+1;?></td>
      <td ><?= $qul['text'];?></td>
      <td ><?= $qul['count'];?></td>
      <td ><a href="?do=result&id=<?=$qul['id'];?>">結果</a></td>
      <td >
      <?php
      if (!empty($_SESSION['login'])) {
        ?>
      <a href="?do=vote&id=<?=$qul['id'];?>">參與投票</a>
      <?php
    }else{
      echo "請先登入";
    }
      ?>
      </td>
    </tr>
    <?php
        }
    ?>
    </table>
</fieldset>