<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/sample_select.css?v=2.0" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.jsを読み込む -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Shippori+Mincho+B1:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <title>Wom-tech 企業口コミ投稿結果</title>

</head>
<body>

<?php

//0. SESSION開始！！
session_start();

//1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

$pdo = db_conn();

//２．データ登録SQL作成

// kadai08 検索窓によるデータ取得　はじまり
    // 検索キーワードを取得
    $search_keyword = isset($_GET['search']) ? trim($_GET['search']) : '';


    // SQLクエリ作成
    if ($search_keyword) {
        // 検索キーワードがある場合、職種で検索
        $sql = "SELECT * FROM wom_table_1 WHERE company LIKE :search"; //LIKEは部分一致選択
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search_keyword . '%', PDO::PARAM_STR);  //%は部分一致表記
    } else {
        // 検索キーワードがない場合、全データを取得
        $sql = "SELECT * FROM wom_table_1";
        $stmt = $pdo->prepare($sql);
    }
    $status = $stmt->execute();

    if($status==false) {
        $error = $stmt->errorInfo();
        exit("SQL_ERROR:".$error[2]);
    }

    $values1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // kadai08 検索窓によるデータ取得　おわり

    // SQLクエリ作成2
    // wom_table_2のデータ取得
    $sql = $search_keyword ? 
    "SELECT * FROM wom_table_2 WHERE comp LIKE :search" : 
    "SELECT * FROM wom_table_2";
    $stmt = $pdo->prepare($sql);
    if ($search_keyword) {
    $stmt->bindValue(':search', '%' . $search_keyword . '%', PDO::PARAM_STR);
    }
    $status = $stmt->execute();
    if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:" . $error[2]);
    }
    $values2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // wom_table_2からwmanagerの値をセッションに保存
    if (!empty($values2)) {
    $_SESSION['wmanager'] = $values2[0]['wmanager'];
    } else {
    $_SESSION['wmanager'] = 'データなし';
    }

    // wom_table_2からwmanagerの値をセッションに保存
    if (!empty($values2)) {
    $_SESSION['overtime'] = $values2[0]['overtime'];
    } else {
    $_SESSION['overtime'] = 'データなし';
    }
    
    // wom_table_2からwmanagerの値をセッションに保存
    if (!empty($values2)) {
    $_SESSION['holiday'] = $values2[0]['holiday'];
    } else {
    $_SESSION['holiday'] = 'データなし';
    }

  // kadai08 検索窓によるデータ取得　おわり


// $sql = "SELECT * FROM wom_table_1"; 
// $stmt = $pdo->prepare($sql);
// $status = $stmt->execute(); //true or false


//３．データ表示
// $view="";
// if($status==false) {
//   //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("SQL_ERROR:".$error[2]);
// }

//全データ取得
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

// star1の平均値をPHPで計算
$sum1 = 0;
$count1 = 0;
foreach ($values1 as $value) {
  if (is_numeric($value['star1'])) {
    $sum1 += $value['star1'];
    $count1++;
  }
}
$average1 = $count1 > 0 ? $sum1 / $count1 : 0; // 平均値を計算

// star2の平均値をPHPで計算
$sum2 = 0;
$count2 = 0;
foreach ($values1 as $value) {
  if (is_numeric($value['star2'])) {
    $sum2 += $value['star2'];
    $count2++;
  }
}
$average2 = $count2 > 0 ? $sum2 / $count2 : 0; // 平均値を計算

// star3の平均値をPHPで計算
$sum3 = 0;
$count3 = 0;
foreach ($values1 as $value) {
  if (is_numeric($value['star3'])) {
    $sum3 += $value['star3'];
    $count3++;
  }
}
$average3 = $count3 > 0 ? $sum3 / $count3 : 0; // 平均値を計算

//JSONに値を渡す場合に使う
$json = json_encode($values1,JSON_UNESCAPED_UNICODE);

?>

<html>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>

<!-- Head[End] -->

<!-- Main[Start] -->

<div class= "wom">
<img class="logo" src="img/W_logo.png" alt="logo" />
<h1>Wom-tech</h1>
</div>

<!-- <div class="company">
  <h3>企業名：トヨタ自動車株式会社</h3>
</div> -->

<div class= "form">
  <form method="GET" action="">
      <label for="search">企業名検索:</label>
      <input type="text" id="search" name="search" value="<?= htmlspecialchars($search_keyword, ENT_QUOTES); ?>">
      <input type="submit" value="検索">
  </form>
</div>

<div class="hyoka">
  <h3><?=$_SESSION["name"]?> さん こんにちは!</h3>
  <h3>総合評価・スコア：</h3>
</div>

  <!-- 親要素にflexを適用 -->
  <div class="graph-container">
    <div class="rader-chart-box">
      <canvas id="myRadarChart" width="200" height="200"></canvas>  
    </div>
  <div class="table-box">
  <table>
      <tr>
        <td>管理職に占める女性の割合</td>
        <td><?= isset($_SESSION["wmanager"]) ? $_SESSION["wmanager"] : 'データなし' ?>%</td>
  </tr>
      <tr>
      <td>平均残業時間</td>
        <td><?= isset($_SESSION["overtime"]) ? $_SESSION["overtime"] : 'データなし' ?>時間</td>
      </tr>
      <tr>
        <td>有給休暇取得率</td>
        <td><?= isset($_SESSION["holiday"]) ? $_SESSION["holiday"] : 'データなし' ?>%</td>
      </tr>
  </table>
</div>
</div>

<div class="graph-container">
<!-- 1つめのグラフ -->
<div class="graph-box">
    <h2 class="graph-title">① 年収に対する満足度</h2>
    <h2>平均値：<?= number_format($average1, 2); ?></h2>
    <!-- PHPで計算された平均値を表示 -->
    <canvas id="myBarChart1" width="200" height="200"></canvas>
</div>

<div class="graph-box">
  <h2 class="graph-title">② 働きがいに対する満足度</h2>
  <h2>平均値：<?= number_format($average2, 2); ?></h2>
  <!-- PHPで計算された平均値を表示 -->  
    <canvas id="myBarChart2" width="200" height="200"></canvas>
</div>

<div class="graph-box">
    <h2 class="graph-title">③ 働きやすさに対する満足度</h2>
    <h2>平均値：<?= number_format($average3, 2); ?></h2>
    <!-- PHPで計算された平均値を表示 -->
    <canvas id="myBarChart3" width="200" height="200"></canvas>
</div>
</div>

</body>


<!-- Main[End] -->

</html>

<script>

//JSON受け取り
var jsonData = <?= json_encode($json, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
  const obj = JSON.parse(jsonData); // PHPから受け取ったJSONデータをオブジェクトに変換

// star1, star2, star3のデータをそれぞれの配列に格納
  var star1 = [];
  obj.forEach(function(item) {
    star1.push(item.star1); // star1列の値を配列に追加
  });

  var star2 = [];
  obj.forEach(function(item) {
    star2.push(item.star2); // star2列の値を配列に追加
  });

  var star3 = [];
  obj.forEach(function(item) {
    star3.push(item.star3); // star3列の値を配列に追加
  });

// star1の中の数値をカウントするためのオブジェクト
  var count1 = {};
  star1.forEach(function(num){
      if(count1[num]){
          count1[num]++;
      }
      else {
          count1[num] = 1;
      }
  });

  var labels1 = Object.keys(count1); // 数値の種類（キー）をラベルに
  var data1 = Object.values(count1); // 出現回数（値）をデータに

// star1の平均値を求める
  let sum1 = star1.reduce((a, b) => a + b, 0);
  let average1 = (sum1 / star1.length).toFixed(2);
  console.log("star1の平均値: " + average1);

// star2の中の数値をカウントするためのオブジェクト
  var count2 = {};
  star2.forEach(function(num){
      if(count2[num]){
          count2[num]++;
      }
      else {
          count2[num] = 1;
      }
  });

  var labels2 = Object.keys(count2); // 数値の種類（キー）をラベルに
  var data2 = Object.values(count2); // 出現回数（値）をデータに

// star3の中の数値をカウントするためのオブジェクト
  var count3 = {};
  star3.forEach(function(num){
      if(count3[num]){
          count3[num]++;
      }
      else {
          count3[num] = 1;
      }
  
  });

  var labels3 = Object.keys(count3); // 数値の種類（キー）をラベルに
  var data3 = Object.values(count3); // 出現回数（値）をデータに   

// グラフを描画する
createMyRadarChart(<?= $average1 ?>, <?= $average2 ?>, <?= $average3 ?>, 'myRadarChart');
createBarChart(labels1, data1, 'myBarChart1');
createBarChart(labels2, data2, 'myBarChart2');
createBarChart(labels3, data3, 'myBarChart3');

// グラフを描画する関数の定義
function createBarChart(labels, data, canvasId){

const ctx = document.getElementById(canvasId).getContext('2d');
new Chart(ctx, {
    type: 'bar', // 棒グラフの指定
    data: {
        labels: labels, // X軸のラベル
        datasets: [{
            data: data, // データセット
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // 背景色
            borderColor: 'rgba(75, 192, 192, 1)', // 枠線の色
            borderWidth: 1 // 枠線の幅
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true, // Y軸が0から始まるように設定
                ticks: {
                    maxTicksLimit : 10
                }
            }

            }
        }
    }
)};


// グラフを描画する関数の定義
function createMyRadarChart(average1, average2, average3, canvasId) {
var ctx = document.getElementById("myRadarChart").getContext('2d');
var myRadarChart = new Chart(ctx, {
    type: 'radar', // レーダーチャートの指定
    data: {    
    labels: ["年収", "働きがい", "働きやすさ"],
    //データセット
    datasets: [{
                label: "平均値",
                //背景色
                backgroundColor: "rgba(51,255,51,0.5)",
                //枠線の色
                borderColor: "rgba(51,255,51,1)",
                //結合点の背景色
                pointBackgroundColor: "rgba(51,255,51,1)",
                //結合点の枠線の色
                pointBorderColor: "#fff",
                //結合点の背景色（ホバ時）
                pointHoverBackgroundColor: "#fff",
                //結合点の枠線の色（ホバー時）
                pointHoverBorderColor: "rgba(51,255,51,1)",
                //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
                hitRadius: 5,
    data: [average1, average2, average3]
    }]
  },

  options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {  // `r` is for radar chart specific settings
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        stepSize: 1,
                        max: 5,
                        font: {
                          family: 'Shippori Mincho B1',
                          weight: 'normal',
                          style: 'normal',
                          size: 15 // 軸ラベルのフォントサイズ変更
                        }
                    },
                    pointLabels: {
                        font: {
                          family: 'Shippori Mincho B1',
                          weight: 'normal',
                          style: 'normal',
                          size: 15 // 項目ラベルのフォントサイズ変更
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                          family: 'Shippori Mincho B1',
                          weight: 'normal',
                          style: 'normal',
                          size: 15 // 凡例ラベルのフォントサイズ変更
                        }
                    }
                }
            }
        }
    });
}

</script>
