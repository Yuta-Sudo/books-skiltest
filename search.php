<?php
require('dbconnect.php');
session_start();
require('func.php');
login_check();

	$recommends = array();
//検索結果
	//ユーザー名
	if ($_GET['search_cat'] == "nickname" ){
	$recommend_spl = "SELECT `book_recommends` . * , `book_members` . `nickname` , `book_members` . `profile_pic` FROM `book_recommends` LEFT JOIN `book_members` on `book_recommends` . `member_id` = `book_members` . `member_id` WHERE `book_recommends` . `book_del_flg` = 0 AND `book_members` . `nickname` LIKE '%" . $_GET['search_key'] . "%' ORDER BY `book_recommends` . `created` DESC";}
	//全てから
	if ($_GET['search_cat'] == "all" ){
	$recommend_spl = "SELECT `book_recommends` . * , `book_members` . `nickname` , `book_members` . `profile_pic` FROM `book_recommends` LEFT JOIN `book_members` on `book_recommends` . `member_id` = `book_members` . `member_id` WHERE `book_recommends` . `book_del_flg` = 0 AND `book_members` . `nickname` LIKE '%" . $_GET['search_key'] . "%' OR `book_recommends` . `bookname` LIKE '%" . $_GET['search_key'] . "%' OR `book_recommends` . `reason` LIKE '%" . $_GET['search_key'] . "%' ORDER BY `book_recommends` . `created` DESC";}
	//タイトル・理由
	if ($_GET['search_cat'] == "bookname" || $_GET['search_cat'] == "reason"){
	$recommend_spl = "SELECT `book_recommends` . * , `book_members` . `nickname` , `book_members` . `profile_pic` FROM `book_recommends` LEFT JOIN `book_members` on `book_recommends` . `member_id` = `book_members` . `member_id` WHERE `book_recommends` . `book_del_flg` = 0 AND `book_recommends` . `" . $_GET['search_cat'] . "` LIKE '%" . $_GET['search_key'] . "%' ORDER BY `book_recommends` . `created` DESC";}

	$recommend_stmt = $dbh->prepare($recommend_spl);
	$recommend_stmt->execute();

	while (true) {
	  $recommend = $recommend_stmt->fetch(PDO::FETCH_ASSOC);
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
	<title>検索結果</title>
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
					<div style="background-color: #fff; border-radius: 3%; padding: 10px 15px;">
						<div style="margin: 10px 0px;">
							<h2>検索結果</h2>
							<p style="font-size: 20px;">
								<?php echo ($_GET['search_key'])?>
							</p>
							<p style="font-size: 18px; margin-top: 4px; text-align: right;">
								で検索しました
							</p>
							<form method="get" action="search.php">
								
								<p style="font-size: 18px;">
								<select name="search_cat" style="display: inline;">
								<?php if ($_GET['search_cat'] == "bookname"): ?>
								<option selected value="bookname"  >タイトルから</option>
								<?php endif ?>
								<?php if ($_GET['search_cat'] == "reason"): ?>
								<option selected value="reason"  >理由から</option>
								<?php endif ?>
								<?php if ($_GET['search_cat'] == "nickname"): ?>
								<option selected value="bookname"  >ユーザー名から</option>
								<?php endif ?>
								<?php if ($_GET['search_cat'] == "all"): ?>
								<option selected value="all" >全てから</option>
								<?php endif ?>
								<option value="bookname">タイトルから</option>
								<option value="reason">理由から</option>
								<option value="nickname">ユーザー名から</option>
								<option value="all">全てから</option>
								</select>
								検索
								</p>
								<input type="text" name="search_key" style="width:172px;" value="<?php echo $_GET['search_key'] ?>">
								<button type="submit">実行</button>
							</form>
						</div>
					</div>
				</div><?php foreach ($recommends as $review) :?>
				<div class="col-md-3 col-sm-3 review " style="height: 307px; margin-bottom: 30px;">
					<div class="gtco-testimony gtco-left">
						<blockquote>
							<?php if ($review['member_id'] != $_SESSION['id']): ?>
							<div style="background-color:rgba(255,255,255,0.8);">
							<?php endif ?>
								<?php if ($review['member_id'] == $_SESSION['id']): ?>
								<div style="background-color:rgba(0,0,255,0.1);">
								<?php endif ?>
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
									<cite class="author" style="margin-top: 2px;">
										<?php echo $review['nickname'] ?>
									</cite>
									<div class="row">
										<div class="col-md-12 col-sm-12" style="height:85px; overflow:hidden; overflow-y:scroll; border:0px solid #ccc; padding:0 20px;">
											<p style="color:#000; word-wrap: break-word; display: inline-block; width: 200px;"><?php echo $review['reason'] ?></p>
										</div>
									</div>
								<?php if ($review['member_id'] != $_SESSION['id']): ?>
								</div>
								<?php endif ?>
							<?php if ($review['member_id'] == $_SESSION['id']): ?>
							</div>
							<?php endif ?>
						</blockquote>
					</div>
				</div><?php endforeach; ?>
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

