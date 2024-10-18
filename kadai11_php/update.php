<?php

//0. SESSION開始！！
session_start();

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$company = $_POST["company"];
$gender = $_POST["gender"];
$role = $_POST["role"];
$join = $_POST["join"];
$status = $_POST["status"];
$experience = $_POST["experience"];
$type = $_POST["type"];
$position = $_POST["position"];
$star1 = $_POST["star1"];
$star2 = $_POST["star2"];
$star3 = $_POST["star3"];
$memo1 = $_POST["memo1"];
$memo2 = $_POST["memo2"];
$id = $_POST["id"];

//2. DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }
// function db_conn(){
//   try {
//     $db_name = "gs_db";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
//   } catch (PDOException $e) {
//     exit('DB Connection Error:'.$e->getMessage());
//   }
// }
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();

try{

//3. トランザクション開始（必要なら）
$pdo->beginTransaction();

//３．データ登録SQL作成
$sql ="UPDATE wom_table_1 SET company=:company,gender=:gender,role=:role,`join`=:join,status=:status,experience=:experience,type=:type,position=:position,star1=:star1,star2=:star2,star3=:star3,memo1=:memo1,memo2=:memo2 WHERE id=:id";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':company',     $company,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender',      $gender,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':role',        $role,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':join',        $join,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':status',      $status,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':experience',  $experience,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':type',        $type,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':position',    $position,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star1',       $star1,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star2',       $star2,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star3',       $star3,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo1',       $memo1,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo2',       $memo2,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',          $id,          PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{

//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
// function sql_error($stmt){
//   $error = $stmt->errorInfo();
//   exit("SQL_ERROR:".$error[2]);
// }

// 5. コミットしてデータを確定
  $pdo->commit();

// ここに全ての処理が含まれる
redirect("select.php");
exit();

}

} catch (Exception $e) {
    // トランザクション中に例外が発生した場合のロールバック処理
    $pdo->rollBack();
    exit('Transaction Failed: ' . $e->getMessage());
}

?>
