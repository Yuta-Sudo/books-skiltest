<?php 
require('dbconnect.php');
session_start();
// require('func.php');
// login_check();

if(!empty($_POST)){
	$type = substr($_FILES['book_pic']['name'], -3);
	$type = strtolower($type);

	if ($type == 'jpg' || $type == 'png' || $type == 'gif' ){
	$book_pic = date('YmdHis') . $_FILES['book_pic']['name'];
	move_uploaded_file($_FILES['book_pic']['tmp_name'], 'pic_reommend/'.$book_pic);
	}else{
	$error['image']  = 'type';
	}

	$book_sql = 'INSERT INTO `book_recommend` SET  `bookname`, `member_id`, `reason`, `book_pic`, `created` = NOW() ';
	$book_data = array($_POST['bookname'],$_SELLECT['member_id'],$_POST['reason'],$_POST['book_pic']);
	$stmt = $dbh->prepare($book_sql);
	$stmt->execute($book_data);
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
	<title>新規投稿</title>
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

	</head>
	<body>

	<div class="gtco-loader"></div>
	<div id="page">

		<nav class="gtco-nav" role="navigation">
			<div class="gtco-container">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div><a href="index.html"><h1 style="font-size: 30px; color: #a9a9a9; margin: auto; ">投稿する</h1></a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">
						<ul>
							<li class="active"><a href="home.php">Home</a></li>
							<li><a href="post.php">投稿する</a></li>
							<li><a href="profile.php">マイページ</a></li>
							<li><a href="logout.php">ログアウト</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>

		<header id="gtco-header" class="gtco-cover" role="banner">
			<style>#gtco-header{margin-top:-53px;   background-image: url("assets/images/p0521_l.png")}</style>
			<div class="gtco-container">
				<div class="row header-img">
					<div class="col-md-1 col-xs-0"></div>
					<div class="col-md-10 col-md-offset-0 text-left">
						<div class="display-t">
							<div class="display-tc">
								<div class="row header-form">
									<h1 style="text-align:center; font-family: 'Gulim' ,sans-serif ;">おすすめの本を共有しよう</h1>
									<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
											<div class="login">
													<div class="col-md-6 copy animate-box" >
													<!-- 本の名前 -->
														<div class="form-group" style="padding:0px 30px;">
															<label class="control-label">本の名前</label>
															<input type="text" name="bookname" class="form-control" placeholder="例： 吾輩は猫である">
														</div>
													<!-- パスワード -->
														<div class="form-group" style="padding:0px 30px;">
															<label class=" control-label">本の写真<span style="font-size: 12px;">(jpg、png、gifにて)</span></label>
															<input type="file" name="book_pic" class="form-control">
															<?php if (isset($error['image']) && $error['image'] == 'type') { ?>
															<p class="error">* jpg、png、gifのいずれかの拡張子を選んでください。</p>
															<?php } ?>
														</div>
														</div>
														<div class="col-md-6 copy animate-box" >
													<!-- 本の名前 -->
														<div class="form-group" style="padding:0px 30px;">
															<label class="control-label">おすすめする理由</label>
															<textarea rows="6" style="resize:vertical; background: rgba(0, 0, 0, 0.1);" name= "reason" class="full-width form-control" placeholder="おすすめポイント！" ></textarea>
														</div>
														</div>

													</div>
												</form>
										</div>
									</div>
								</div>
							<div class="col-md-1 col-xs-0"></div>
						</div>
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

