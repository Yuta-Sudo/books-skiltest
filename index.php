<?php 
require('dbconnect.php');
session_start();
if (isset($_COOKIE['email]']) && !empty($_COOKIE['email]'])) {
  $_POST['email]'] = $_COOKIE['email]'];
  $_POST['password]'] = $_COOKIE['password]'];
  $_POST['save'] = 'on' ;
}
  if (!empty($_POST) && isset($_POST)) {
  //ログイン認証
    $sql =' SELECT * FROM `book_members` WHERE `email`= ? AND `password`= ? ';
    $data = array( $_POST['email'] , sha1($_POST['password']) );
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['nickname'] = $member['nickname'];
    if($member == false){
      $error['login'] = 'failed';
    }else{
      //認証成功
      $_SESSION['id'] = $member['member_id'];
      $_SESSION['time'] = time();
    if (isset($_POST['save']) && $_POST['save'] == 'on'){
      setcookie('email', $_POST['email'], time()+60*60*24*14);
      setcookie('password' , $_POST['password'], time()+60*60*24*14);
    }
    header('Location: home.php');
      exit;
}
}

 ?>
<!DOCTYPE HTML>
<!--
	Cube by FreeHTML5.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://freehtml5.co
-->
<html lang="ja">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RYB</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- Modernizr JS -->
	<script src="assets/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
	body{
  background-image: url(../images/2d6c505e9f92c2262951079f4822b1a4_s.jpg);
  background-size: cover;
  color: black;
  height:100%;}
</style>
	</head>
	<body>

	<div class="gtco-loader"></div>
	<div id="page">
		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div><a href="../index.php"><h1 style="font-size: 30px; color: #a9a9a9; margin: auto; ">Reccomend your book</h1></a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">

<!-- ログイン、登録、確認画面ではコメントアウト// -->
					<!-- 	<ul>
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li class="has-dropdown">
								<a href="services.html">Services</a>
								<ul class="dropdown">
									<li><a href="#">Web Design</a></li>
									<li><a href="#">eCommerce</a></li>
									<li><a href="#">Branding</a></li>
									<li><a href="#">API</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="#">Dropdown</a>
								<ul class="dropdown">
									<li><a href="#">HTML5</a></li>
									<li><a href="#">CSS3</a></li>
									<li><a href="#">Sass</a></li>
									<li><a href="#">jQuery</a></li>
								</ul>
							</li>
							<li><a href="portfolio.html">Portfolio</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul> -->
<!-- // -->

					</div>
				</div>
			</div>
		</nav>

		<header id="gtco-header" class="gtco-cover" role="banner">
			<style>#gtco-header{margin-top:-53px;}</style>
			<div class="gtco-container">
				<div class="row header-img">
					<div class="col-md-1 col-xs-0"></div>
					<div class="col-md-10 col-md-offset-0 text-left">
						<div class="display-t">
							<div class="display-tc">
								<div class="row header-form">
									<h1 style="text-align:center; font-family: 'Gulim' ,sans-serif ;">おすすめの本を共有しよう</h1>
										<div class="col-md-6 copy animate-box" >
											<div class="login">
												<form method="post" action="" class="form-horizontal" role="form">
													<!-- メールアドレス -->
													<div class="form-group" style="padding:0px 30px;">
														<label class="control-label">メールアドレス</label>
														<input type="email" name="email" class="form-control" placeholder="例： seed@nex.com">
													</div>
													<!-- パスワード -->
													<div class="form-group" style="padding:0px 30px;">
														<label class="control-label">パスワード</label>
														<input type="password" name="password" class="form-control" placeholder="">
													</div>
													<div class="row" style="padding:0px 30px; ">
														<label class="col-sm-6 control-label"">自動ログイン</label>
														<div class=" col-sm-6 form-group" style="padding-top: 10px;">
															<input type="checkbox" name="save" value="on">オンにする
														</div>
													</div>
													<div class="form-group control-label" style="padding:0px 30px;">
														<button class="top-btn" type='submit' class="button button-primary " style="width: 100%;" >ログイン</button>
													</div>
													<?php if ((isset($error['login'])) && $error['login'] == 'failed') { ?>
														<div>
															<p class= "error">emailまたはpasswordが間違っています。</p>
														</div>
													<?php } ?>
													</form>
												</div>
											</div>
											<div class="col-md-6 text-center animate-box register">
												<div class="register-content">
													<h1 style="font-size: 30px; margin-top: 30px;">ユーザー登録</h1>
													<p style="font-size: 15px;">いろんな人のおすすめの本を見てみよう</p>
													<a href="register/register.php">
														<button style="margin-top: 30px;" type='submit' class="top-btn button button-primary " >新規登録する</button>
													</a>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-1 col-xs-0"></div>
					</div>
				</div>
		</header>
		<!-- END #gtco-header -->
	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="assets/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="assets/js/main.js"></script>

	</body>
</html>

