<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Shippori+Mincho+B1:wght@400;500;600;700;800&display=swap" rel="stylesheet">



<title>ログイン</title>
</head>
<body>

<div class= "wom">
<img class="logo" src="img/W_logo.png" alt="logo" />
</div>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<div class = form>
<nav class="navbar-default">LOGIN</nav>
<form name="form1" action="login_act.php" method="post">
<br>ユーザID
<br><input type="text" name="lid">
<br>パスワード
<br><input type="password" name="lpw">
<br><input type="submit" value="ログイン">
</form>
</div>

<div class = "guest">
<h1><a href="select1.php">データを見る</a></h1>
</div>

<div class= "cr">
<h1>Wom-tech All Rights Reserved.</h1>
</div>

</body>
</html>