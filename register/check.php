<?php 
require('../dbconnect.php');
session_start();
  // echo('<br>');  echo('<br>');
  // echo('<br>');  echo('<br>');
  // echo('<br>');  echo('<br>');
  //  echo('<pre>');
  // var_dump($_SESSION);
  // echo('</pre>');
if(!empty($_POST)){
  $nickname= $_POST['nickname'];
  $email= $_POST['email'];
  $password=sha1($_POST['password']);
  $pic= $_POST['pic'];

  $sql = 'INSERT INTO `book_members` SET `nickname` = ? , `email` =  ?, `password` = ? , `profile_pic` = ? ,`member_del_flg`= 0,`created` = NOW()';
  $data = array($nickname, $email,$password, $pic);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $_SESSION['nickname'] = $_SESSION['register']['nickname'];

  unset($_SESSION['register']);
  header('Location: ../home.php');
 	exit();
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
	<title>登録確認</title>
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
						<div clas="row">
							<ul>
								<li class="col-xs-6 text-center menu-1"><p>投稿する</p></li>
								<li class="col-xs-6 text-center menu-1"><p style="color: #fff; text-decoration: underline;">マイページ</p></li>
							</ul>
						</div>
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
													<form method="post" class="form-horizontal">
															<!-- ニックネーム -->
															<div class="form-group">
																<label class="col-sm-4 control-label">ニックネーム:</label>
																<div class="col-sm-8">
																	<p class="check"><?php echo($_SESSION['register']['nickname']); ?>
																	<input type="hidden" name="nickname" value="<?php echo($_SESSION['register']['nickname']) ?>">
																	</p>
																</div>
															</div>
															<!-- メールアドレス -->
															<div class="form-group">
																<label class="col-sm-4 control-label">メールアドレス:</label>
																<div class="col-sm-8">
																	<p class="check">
																		<?php echo($_SESSION['register']['email']); ?>
																		<input type="hidden" name="email" value="<?php echo($_SESSION['register']['email']) ?>">
																	</p>
																</div>
															</div>
															<!-- パスワード -->
															<div class="form-group">
																<label class="col-sm-4 control-label">パスワード:</label>
																<div class="col-sm-8">
																	<p class="check">
																		<?php echo($_SESSION['register']['password']); ?>
																		<input type="hidden" name="password" value="<?php echo($_SESSION['register']['password']) ?>">
																	</p>
																</div>
															</div>
															<!-- プロフィール写真 -->
															<div class="form-group">
																<label class="col-sm-4 control-label">プロフィール写真:</label>
																<div class="col-sm-8" >
																	<img style="width: 200px; height: 200px; border-radius: 20;" src="../pic_profile/<?php echo($_SESSION['register']['pic']); ?>">
																	<input type="hidden" name="pic" value="<?php echo($_SESSION['register']['pic']) ?>">
																</div>
															</div>
															<!-- 送信 -->
															<div class="form-group control-label" style="padding:0px 30px;">
																<input type="submit" class="top-btn" value="登録" style="width: 100%;" >
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

