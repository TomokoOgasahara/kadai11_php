<?php
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
$pdo = db_conn();

//3. トランザクション開始（必要なら）
$pdo->beginTransaction();

//３．データ登録SQL作成
$sql ="INSERT INTO wom_table_1(company,gender,role,`join`,status,experience,type,position,star1,star2,star3,memo1,memo2,datetime)
VALUES(:company,:gender,:role,:join,:status,:experience,:type,:position,:star1,:star2,:star3,:memo1,:memo2,sysdate());";
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
}

ob_start();  // バッファリングを開始


// ここに全ての処理が含まれる
redirect("index.php");
ob_end_flush();  // バッファリングをクリア
exit();

?>
