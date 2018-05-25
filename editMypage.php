<?php
require('dbconnect.php');
session_start();
require('func.php');
login_check();



//自分のプロフィール情報
	$myprof_spl = "SELECT * FROM `book_members`WHERE `member_id` = " . $_SESSION['id'];
	$myprof_stmt = $dbh->prepare($myprof_spl);
	$myprof_stmt->execute();
	$myprof = $myprof_stmt->fetch(PDO::FETCH_ASSOC);
	$created = $myprof['created'];
	$created = date("Y-m-d", strtotime($created));

	//プロフィール編集

	if (!empty($_POST)) {
	//空の場合(valu値ではく、空の状態)
		//ユーザーネーム
		if ($_POST['nickname']=='') {
		$error['nickname'] ='blank';
		}
		//アドレス
		if ($_POST['email'] != $myprof['email'] && $_POST['email']=='') {
		$error['email'] ='blank';
		}elseif($_POST['email'] != $myprof['email'] ) {
		$sql= 'SELECT COUNT(*) AS `mail_count` FROM `book_members` WHERE `email` = ?';
		$data = array($_POST['email']);
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
		$mail_count = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($mail_count['mail_count'] >= 1) {
			$error['email'] = 'duplicated';
			}
		}
	}
	if (!empty($_FILES)) {
	//写真関係
	$type = substr($_FILES['pic']['name'], -3);
	$type = strtolower($type);

	if ($type == 'jpg' || $type == 'png' || $type == 'gif' ){
	$pic = date('YmdHis') . $_FILES['pic']['name'];
	move_uploaded_file($_FILES['pic']['tmp_name'], 'pic_profile/'.$pic);
	}else{
	$pic = $myprof['profile_pic'];
	}

	if(!isset($error)){
		$nickname = htmlspecialchars($_POST['nickname']);
		$email = htmlspecialchars($_POST['email']);
		$prof_sql = 'UPDATE `book_members` SET `nickname` = ?, `email` = ?, `profile_pic` = ?, `modified` = NOW() WHERE `member_id` =? ';
		$prof_data = array($nickname, $email, $pic, $_SESSION['id']);
		$stmt = $dbh->prepare($prof_sql);
		$stmt->execute($prof_data);
	header('Location: mypage.php');
	exit();
	}else{
		$error['image']  = 'type';
		}
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
	<title>情報の編集</title>
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
						<li><a href="home.php">Home</a></li>
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
				<div class="row header-img">
					<div class="col-md-1 col-xs-0"></div>
						<div class="col-md-10text-left">
							<div class="display-t">
								<div class="display-tc">
									<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
										<div class="header-form">
											<div class="row">
												<div class="login">
													<h1 style="text-align:center; font-family: 'Gulim' ,sans-serif ;">
														プロフィール情報の編集
													</h1>
													<div class="col-md-6 copy animate-box" >
														<div class="form-group" style="padding:0px 30px 30px 30px;">
															<label class="control-label">本の写真<span style="font-size: 12px;">(jpg、png、gifにて)</span></label>
															<input id="selfile" type="file" name="pic" class="form-control">
																<?php if (isset($error['image']) && $error['image'] == 'type') { ?>
																	<p class="error">* jpg、png、gifのいずれかの拡張子を選んでください。</p>
																<?php } ?>
															<div style="padding:0px 27.49px;">
																<div id="bg" style="padding-left: 77.5px;">
																	<p class="control-label" style="text-align: left;">変更前</p>
																	<img id="wait" src="pic_profile/<?php echo $myprof['profile_pic'] ?>" width="300" height="300">
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6 copy animate-box" >
													<!-- ユーザーネーム -->
														<div class="form-group" style="padding:  0px 30px;">
															<label class="control-label">ユーザーネーム</label>
															<input type="text" name="nickname" class="form-control" style="width: 100%;" value="<?php echo $myprof['nickname'] ?>">
																<?php if ((isset($error['nickname'])&& $error['nickname']=='blank')): ?>
																<p class="error">ニックネームを入力してください</p>
																<?php endif; ?>
														</div>
													<!-- Eメール -->
														<div class="form-group" style="padding:0px 30px;">
															<label class="control-label">メールアドレス</label>
															<input type="email" name="email" class="form-control" style="width: 100%;" value="<?php echo $myprof['email'] ?>">
																<?php if (isset($error['email'])&& $error['email']=='blank'): ?>
																<p class="error">* メールアドレスを入力してください </p>
																<?php endif ?>
																<?php if (isset($error['email'])&& $error['email']=='duplicated'): ?>
																<p class="error">* 新しく入力されたアドレスは登録済みです </p>
																<?php endif ?>
														</div>
														<div class="row">
															<div class="col-md-2 col-xs-2"></div>
																<div class="col-md-8 col-xs-8">
																	<button class="top-btn" type='submit' class="button button-primary " style="width: 100%; margin: 25px 0px;" >編集を完了する</button>
																</div>
															<div class="col-md-2 col-xs-2"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							<div class="col-md-1 col-xs-0"></div>
						</div>
					</div>
				</div>
		</div>

<script>
var pre = document.getElementById("selfile");


pre.addEventListener("change", function(evt){
document.getElementById("wait").innerHTML = "変更中";
  var file = evt.target.files;
  var reader = new FileReader();
  //dataURL形式でファイルを読み込む
  reader.readAsDataURL(file[0]);
  //ファイルの読込が終了した時の処理
  reader.onload = function(){
    var dataUrl = reader.result;
    //読み込んだ画像とdataURLを書き出す
    document.getElementById("bg").innerHTML = "<p class=’control-label’ style='text-align: left;'>変更後</p><img src='" + dataUrl + "' width='300' height='300' >";
    document.getElementById("dturl").value = dataUrl;
  }
},false);
</script>
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

