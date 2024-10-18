<?php

//0. SESSION開始！！
session_start();

//１．PHP
$id = $_GET["id"];

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM wom_table_1 WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($cleaned_values, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT);

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset="UTF-8">
  <title>Wom-tech 女性活躍口コミサイト更新</title>

  <link href="css/sample.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Shippori+Mincho+B1:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
<div class="jumbotron">
   <fieldset>
    <legend>Wom-tech 女性活躍口コミサイト更新</legend>
</div>

<div class="form">
    <br><label>企業名：<input type="text" name="company" value="<?=$values["company"] ?>"></label><br>

    <br><label>性別：
    <input type="radio" name="gender" value="男" <?= $values["gender"] == "男" ? "checked" : "" ?>> 男
    <input type="radio" name="gender" value="女" <?= $values["gender"] == "女" ? "checked" : "" ?>> 女
    <input type="radio" name="gender" value="回答しない" <?= $values["gender"] == "回答しない" ? "checked" : "" ?>> 回答しない
    </label><br>

    <br><label>職種：
    <select name="role">
      <option value="商品企画" <?= $values["role"] == "商品企画" ? "selected" : "" ?>>商品企画</option> 
      <option value="研究開発" <?= $values["role"] == "研究開発" ? "selected" : "" ?>>研究開発</option> 
      <option value="生産技術" <?= $values["role"] == "生産技術" ? "selected" : "" ?>>生産技術</option> 
      <option value="生産管理" <?= $values["role"] == "生産管理" ? "selected" : "" ?>>生産管理</option> 
      <option value="品質管理" <?= $values["role"] == "品質管理" ? "selected" : "" ?>>品質管理</option> 
      <option value="製造" <?= $values["role"] == "製造" ? "selected" : "" ?>>製造</option> 
      <option value="営業" <?= $values["role"] == "営業" ? "selected" : "" ?>>営業</option> 
      <option value="広報・マーケティング" <?= $values["role"] == "広報・マーケティング" ? "selected" : "" ?>>広報・マーケティング</option> 
      <option value="法務" <?= $values["role"] == "法務" ? "selected" : "" ?>>法務</option>
      <option value="総務・人事" <?= $values["role"] == "総務・人事" ? "selected" : "" ?>>総務・人事</option>      
    </select>
    </label><br> 
    
    <br><label>入社形態：
    <input type="radio" name="join" value="新卒" <?= $values["join"] == "新卒" ? "checked" : "" ?>>新卒
    <input type="radio" name="join" value="キャリア" <?= $values["join"] == "キャリア" ? "checked" : "" ?>>キャリア
    </label><br>
  
    <br><label>状態：
    <input type="radio" name="status" value="現職" <?= $values["status"] == "現職" ? "checked" : "" ?>>現職
    <input type="radio" name="status" value="退職済" <?= $values["status"] == "退職済" ? "checked" : "" ?>>退職済
    </label><br>    

    <br><label>在籍年数：<input type="text" name="experience" value="<?=$values["experience"] ?>"></label><br>

    <br><label>雇用形態：
    <input type="radio" name="type" value="正社員" <?= $values["type"] == "正社員" ? "checked" : "" ?>>正社員
    <input type="radio" name="type" value="パート・派遣" <?= $values["type"] == "パート・派遣" ? "checked" : "" ?>>パート・派遣
    </label><br>

    <br><label>役職：<input type="text" name="position" value="<?= $values["position"] ?>"></label><br>

    <br>①年収/給与：
    <input type="radio" name="star1" value="1" <?= $values["star1"] == "1" ? "checked" : "" ?>>1
    <input type="radio" name="star1" value="2" <?= $values["star1"] == "2" ? "checked" : "" ?>>2
    <input type="radio" name="star1" value="3" <?= $values["star1"] == "3" ? "checked" : "" ?>>3
    <input type="radio" name="star1" value="4" <?= $values["star1"] == "4" ? "checked" : "" ?>>4
    <input type="radio" name="star1" value="5" <?= $values["star1"] == "5" ? "checked" : "" ?>>5

    <br><br>②働きやすさ(制度・文化)：
    <input type="radio" name="star2" value="1" <?= $values["star2"] == "1" ? "checked" : "" ?>>1
    <input type="radio" name="star2" value="2" <?= $values["star2"] == "2" ? "checked" : "" ?>>2
    <input type="radio" name="star2" value="3" <?= $values["star2"] == "3" ? "checked" : "" ?>>3
    <input type="radio" name="star2" value="4" <?= $values["star2"] == "4" ? "checked" : "" ?>>4
    <input type="radio" name="star2" value="5" <?= $values["star2"] == "5" ? "checked" : "" ?>>5

    <br><br>③働きがい(成長性・公平性)：
    <input type="radio" name="star3" value="1" <?= $values["star3"] == "1" ? "checked" : "" ?>>1
    <input type="radio" name="star3" value="2" <?= $values["star3"] == "2" ? "checked" : "" ?>>2
    <input type="radio" name="star3" value="3" <?= $values["star3"] == "3" ? "checked" : "" ?>>3
    <input type="radio" name="star3" value="4" <?= $values["star3"] == "4" ? "checked" : "" ?>>4
    <input type="radio" name="star3" value="5" <?= $values["star3"] == "5" ? "checked" : "" ?>>5

    <br><br>良い点：<br><textarea name="memo1" cols="30" rows="10"> <?= $values["memo1"] ?> </textarea>
    <br><br>悪い点：<br><textarea name="memo2" cols="30" rows="10"> <?= $values["memo2"] ?> </textarea>

    <input type="hidden"  name="id" value="<?=$values["id"]?>">

    <br><br><button class="glass-button" input type="submit" value="送信">送信</button>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>

<!-- Main[End] -->





