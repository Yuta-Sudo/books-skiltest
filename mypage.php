<?php
require('dbconnect.php');
session_start();
require('func.php');
login_check();

//自分のプロフィール情報
	$myprof_spl = "SELECT `nickname`, `email`, `password`, `profile_pic` , `created` FROM `book_members`WHERE `member_id` = " . $_SESSION['id'];
	$myprof_stmt = $dbh->prepare($myprof_spl);
	$myprof_stmt->execute();
	$myprof = $myprof_stmt->fetch(PDO::FETCH_ASSOC);

	$created = $myprof['created'];
	$created = date("Y-m-d", strtotime($created));

//自分のレビュー用
	$recommends = array();
	$recommend_spl = "SELECT * FROM `book_recommends` WHERE `book_recommends` . `book_del_flg` = 0 AND `member_id` = " . $_SESSION['id'] . " ORDER BY `book_recommends` . `created` DESC";
	$recommend_stmt = $dbh->prepare($recommend_spl);
	$recommend_stmt->execute();

	while (true) {
	  $recommend = $recommend_stmt->fetch(PDO::FETCH_ASSOC);
	   // var_dump($recommend);
	  if ($recommend == false) {
	    break; // データがなくなったら繰り返し処理を終える
	    }
	  $recommends[] = $recommend;
	}
	?>
<!DOCTYPE HTML>
<!--
	Cube by FreeHTML5.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://freehtml5.co
-->
<html >
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>マイページ</title>
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
	<script src="assets/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
<style>
body{
	background-image: url("assets/images/p0521_l.png");
	background-size: cover; }
</style>
<div class="gtco-loader"></div>
<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container" >
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div><a href="home.php"><h1 style="font-size: 30px; color: #a9a9a9; margin: auto; ">Reccomend your book</h1></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class="active"><a href="home.php">Home</a></li>
						<li><a href="post.php">投稿する</a></li>
						<li><a href="mypage.php">マイページ</a></li>
						<li><a href="logout.php">ログアウト</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div class="gtco-section gtco-testimonial gtco-gray" style="padding-top: 100px;">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-3 col-sm-3 review animate-box ">
					<div style="background-color: #fff; border-radius: 3%; padding: 40px 15px;">
						<div style="padding-top: 7px;">
							<h2>マイページ</h2>
							<p style="font-size: 20px;">
								自分の投稿を確認しよう
							</p>
						</div>
						<div style="margin: 30px 0px; padding: 0px 16.5px;">
							<a href="editMypage.php?id=<?php echo $_SESSION['id'] ?>">
								<button>プロフィールを編集する</button>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 review animate-box">
					<div class="row review animate-box" style="background-color:#fff; border-radius: 3%;padding: 0px;">
						<div class="col-md-4 col-sm-4" style="padding:0px;" >
							<div>
								<img src="pic_profile/<?php echo $myprof['profile_pic'] ?>" width="266" height="266" style="border-radius: 3%;">
							</div>
						</div>
						<div class="col-md-8 col-sm-8" style="padding:10px;">
								<h2>プロフィール</h2>
								<label class="control-label">ユーザーネーム</label>
								<p class="check" style="height: auto;">&nbsp;<?php echo($myprof['nickname']); ?></p>
								<label class="control-label">メールアドレス</label>
								<p class="check" style="height: auto;">&nbsp;<?php echo($myprof['email']); ?></p>
								<p>利用開始日:<?php echo $created ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 30px;">
				<?php foreach ($recommends as $review) :?>
				<div class="col-md-3 col-sm-3 review ">
					<div class="gtco-testimony gtco-left">
						<blockquote>
							<div style="background-color:rgba(0,0,255,0.1);">
								<div class ="recommend-pic">
									<a href="detail.php?id=<?php echo $review['recommend_id'] ?>" class="">
										<div>
											<img src="pic_reommend/<?php echo($review['book_pic']); ?>" width="200" height="200">
											<div class="mask">
												<div class="caption"><?php echo $review['bookname'] ?></div>
											</div>
										</div>
									</a>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12" style="height:85px; overflow:hidden; overflow-y:scroll; border:0px solid #ccc; padding:0 20px;">
										<p style="color:#000; word-wrap: break-word; display: inline-block; width: 200px;"><?php echo $review['reason'] ?></p>
									</div>
								</div>
							</div>
						</blockquote>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

	<!-- jQuery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="assets/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<!-- countTo -->
	<script src="assets/js/jquery.countTo.js"></script>
	<!-- Carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/js/magnific-popup-options.js"></script>
	
	<!-- Main -->
	<script src="assets/js/main.js"></script>

	</body>
</html>

