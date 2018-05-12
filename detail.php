<?php 
require('dbconnect.php');
// session_start();
// require('func.php');
// login_check();


	$recommend_sql='SELECT * FROM `book_recommends` WHERE `recommend_id` = ? ';
	$recommend_data= array($_GET['id']);
	$stmt = $dbh->prepare($recommend_sql);
	$stmt->execute($recommend_data);
	$recommend =$stmt -> fetch(PDO::FETCH_ASSOC);
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
	<title>詳細</title>
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
			<div class="gtco-container" ">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div><a href="index.html"><h1 style="font-size: 30px; color: #a9a9a9; margin: auto; ">Reccomend your book</h1></a></div>
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
			<style>#gtco-header{margin-top:-53px;   background-image: url("assets/images/p0521_l.png") } </style>
			<div class="gtco-container">
				<div class="row header-img">
					<div class="col-md-1 col-xs-0"></div>
					<div class="col-md-10 col-md-offset-0 text-left">
						<div class="display-t">
							<div class="display-tc">
								<div class="row header-form" >
									<?php if (isset($_SESSION['id']) && $recommend['member_id'] == $_SESSION['id']) : ?>
									<div class="row" >
										<div class="col-md-4"></div>
										<div class="col-md-4">
											<div class="form-group control-label" style=" padding:30px 30px;">
												<a href="edit.php?id=<?php echo $recommend['recommend_id'] ?>"><button class="top-btn" type='submit' class="button button-primary" >編集する</button></a>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group control-label" style=" padding:30px 30px;">
												<a href="delete.php?id=<?php echo $recommend['recommend_id'] ?>"><button class="top-btn" type='submit' class="button button-primary" >削除する</button></a>
											</div>
										</div>
									</div>
									<?php endif ?>
									<h1 style="text-align:center; font-family: 'Gulim' ,sans-serif ;">本の詳細</h1>
									<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
											<div class="login">
													<div class="col-md-6 copy animate-box" >
													<!-- 本の名前 -->
														<div class="form-group" style="padding:0px 30px;">
															<label class="control-label">本の名前</label>
															<div><p class="check" style="display:inline; height: auto;"><?php echo($recommend['bookname']); ?></p>
														</div>
													<!-- 写真 -->
														<div class="form-group" style="padding:0px 30px;">
															<label class=" control-label">本の写真</label>
															<div>
																<img style="width: 200px; height: 200px; border-radius: 20;" src="pic_reommend/<?php echo($recommend['book_pic']); ?>">
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 copy animate-box"" >
													<!-- 本の名前 -->
													<div class="form-group" style="padding:0px 30px; display:inline; height: auto;" >
														<label class="control-label">おすすめする理由</label>
														<div ><p class="check" style="display:inline; height: auto;"><?php echo($recommend['reason']); ?></p>
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


