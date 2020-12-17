<form>
  <fieldset style="width:50%;margin:20px auto">
    <legend>
      會員登入
    </legend>
    <table>
      <tr>
        <td style="background-color: #eee;width:150px">帳號</td>
        <td><input type="text" name="acc" id="acc"></td>
      </tr>
      <tr>
        <td style="background-color: #eee;width:150px">密碼</td>
        <td><input type="password" name="pw" id="pw"></td>
      </tr>
      <tr>
        <td><input type="button" value="登入" onclick="login()"><input type="reset" value="清除"></td>
        <td><a href="?do=forget">忘記密碼</a>|<a href="?do=reg">尚未註冊</a></td>
      </tr>
    </table>
  </fieldset>
</form>
<script>
  function login() {
    let acc = $("#acc").val()
    let pw = $("#pw").val()

    $.post("api/checkacc.php", {
      acc
    }, function(res) {
      if (res == '1') {
        $.post("api/check_pw.php", {
          acc,
          pw
        }, function(r) {
          if (r =='1') {
            if (acc=='admin') {
              location.href = "backend.php";
            }else{
              location.href = "index.php";
            }
          } else {
            alert("密碼錯誤")
            $("#acc,#pw").val("")
          }
        })
      } else {
        alert("查無帳號")
        $("#acc,#pw").val("")
      }
    })
  }
</script>