<?php
require('../dbconnect.php');
session_start();

if (!empty($_POST)) {
  if ($_POST['nickname']=='') {
    $error['nickname'] ='blank';
    }else{
    $_SESSION['register']['nickname'] = $_POST['nickname'];
    }

  if ($_POST['email']=='') {
    $error['email'] ='blank';
    }

  if ($_POST['password']=='') {
    $error['password'] ='blank';
    }elseif(mb_strlen($_POST['password']) < 4 || mb_strlen($_POST['password']) > 16){
      $error['password'] = 'length';
    }

  if (!isset($error)) {
      $sql= 'SELECT COUNT(*) AS `mail_count` FROM `book_members` WHERE `email` = ?';
      $data = array($_POST['email']);
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $mail_count = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($mail_count['mail_count'] >= 1) {
        $error['email'] = 'duplicated';
      }
      $_SESSION['register']['email'] = $_POST['email'];

      if(!isset($error)){
        $type = substr($_FILES['pic']['name'], -3);
        $type = strtolower($type);

        if ($type == 'jpg' || $type == 'png' || $type == 'gif' ){
        $pic = date('YmdHis') . $_FILES['pic']['name'];
        move_uploaded_file($_FILES['pic']['tmp_name'], '../pic_profile/'.$pic);
        $_SESSION['register']['pic'] = $pic ;
        $_SESSION['register']['password'] = $_POST['password'];
        header('Location: check.php');
        exit();
      }else{
        $error['image']  = 'type';
      }
    }
  }
}
 // header('Location: check.php');
 // exit();
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
	<link rel="stylesheet" href="../assets/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../assets/css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="../assets/css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="../assets/css/style.css">

	<!-- Modernizr JS -->
	<script src="../assets/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

	<div class="gtco-loader"></div>
	<div id="page">
		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div><a href="../index.php"><h1 style="font-size: 30px; color: #a9a9a9; margin: auto; ">新規登録</h1></a></div>
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
						<div class="col-md-10 col-md-offset-0">
							<div class="display-t">
								<div class="display-tc">
									<div class="row header-form ">
										<h1 class="animate-box" style="text-align:center; font-family: 'Gulim' ,sans-serif ;">プロフィールの作成</h1>
										<div class="col-md-1 col-xs-0"></div>
											<div class="col-md-10 copy animate-box" >
												<div class="login">
													<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
															<!-- ニックネーム -->
															<div class="form-group">
																<label class="col-sm-4 control-label">ニックネーム</label>
																<div class="col-sm-8">
																	<?php if (!isset($_SESSION['register']['nickname'])): ?>
																		<input type="text" name="nickname" class="form-control" placeholder="例： S-夏目">
																	<?php endif; ?>
																	<?php if (isset($_SESSION['register']['nickname'])): ?>
																		<input type="text" name="nickname" class="form-control" value="<?php echo $_SESSION['register']['nickname'] ?>">
																	<?php endif; ?>
																	<?php if (isset($error['nickname'])&& $error['nickname']=='blank') { ?>
																		<p class="error">ニックネームを入力してください</p>
																	<?php } ?>
																</div>
															</div>
															<!-- メールアドレス -->
															<div class="form-group">
																<label class="col-sm-4 control-label">メールアドレス</label>
																<div class="col-sm-8">
																	<input type="email" name="email" class="form-control" placeholder="例： wagahai@neko.com" autocomplete="off">
																		<?php if (isset($error['email'])&& $error['email']=='blank') { ?>
																			<p class="error">メールアドレスを入力してください</p>
																		<?php } elseif(isset($error['email'])&& $error['email']=='duplicated'){?>
																			<p class="error">* 入力されたメールアドレスは登録済みです </p>
																		<?php } ?>
																</div>
															</div>
															<!-- パスワード -->
															<div class="form-group">
																<label class="col-sm-4 control-label">パスワード</label>
															<div class="col-sm-8">
																<input type="password" name="password" class="form-control" placeholder="4文字以上16文字以内">
																	<?php if (isset($error['password']) && $error['password'] == 'blank') { ?>
																		<p class="error">* パスワードを入力してください。</p>
																	<?php } elseif(isset($error['password']) && $error['password'] == 'length') { ?>
																		<p class="error">* パスワードは4文字以上、16文字以内で入力してください。</p>
																	<?php } ?>
																</div>
															</div>
															<!-- プロフィール写真 -->
															<div class="form-group">
																<label class="col-sm-4 control-label">プロフィール写真<br><span style="font-size: 12px;">(jpg、png、gifにて)</span></label>
																<div class="col-sm-8" style="padding-top:  11px;">
																	<input type="file" name="pic" class="form-control">
																		<?php if (isset($error['image']) && $error['image'] == 'type') { ?>
																			<p class="error">* jpg、png、gifのいずれかの拡張子を選んでください。</p>
																		<?php } ?>
																</div>
															<!-- 送信 -->
															</div>
															<div class="form-group control-label" style="padding:0px 30px;">
																<input type="submit" class="top-btn"  value="確認へ" style="width: 100%;" >
															</div>
														</form>
													</div>
												<div class="col-md-1 col-xs-0"></div>
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
	<script src="../assets/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../assets/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../assets/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="../assets/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="../assets/js/jquery.magnific-popup.min.js"></script>
	<script src="../assets/js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="../assets/js/main.js"></script>

	</body>
</html>

