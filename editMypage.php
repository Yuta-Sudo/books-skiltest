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
	$recommend_spl = "SELECT * FROM `book_recommends` WHERE `member_id` = " . $_SESSION['id'] . " ORDER BY `book_recommends` . `created` DESC";
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


	//プロフィール編集
	if (!empty($_POST)) {
		if ($_POST['nickname']=='') {
		$error['nickname'] ='blank';
		}

		if ($_POST['email']=='') {
		$error['email'] ='blank';
		}

		if (!isset($error)) {
			if ($_POST['email'] != $myprof['email'] ) {
			$sql= 'SELECT COUNT(*) AS `mail_count` FROM `book_members` WHERE `email` = ?';
			$data = array($_POST['email']);
			$stmt = $dbh->prepare($sql);
			$stmt->execute($data);
			$mail_count = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($mail_count['mail_count'] >= 1) {
			$error['email'] = 'duplicated';
			}
			}
		

		if(!isset($error)){
		$type = substr($_FILES['pic']['name'], -3);
		$type = strtolower($type);

		if ($type == 'jpg' || $type == 'png' || $type == 'gif' ){
		$pic = date('YmdHis') . $_FILES['pic']['name'];
		move_uploaded_file($_FILES['pic']['tmp_name'], 'pic_profile/'.$pic);

			$nickname = htmlspecialchars($_POST['nickname']);
			$email = htmlspecialchars($_POST['email']);

			$prof_sql = 'UPDATE `book_members` SET `nickname` = ?, `email` = ?, `profile_pic` = ?, `modified` = NOW() WHERE `member_id` =? ';
			$prof_data = array($nickname,$email,$pic,$_SESSION['id']);
			$stmt = $dbh->prepare($prof_sql);
			$stmt->execute($prof_data);
		header('Location: mypage.php');
		exit();
		}else{
		$error['image']  = 'type';
		}
		}
	}
}
//検証用
// echo('<br>');  echo('<br>');
// echo('<br>');  echo('<br>');
echo('<br>');  echo('<br>');

echo ('<pre>');
var_dump($recommends);
echo ('</pre>');
// echo ('<pre>');
// var_dump($myid);
// echo ('</pre>');
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
	<title>ホーム</title>
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
			<form  method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-3 col-sm-3 review animate-box ">
					<div style="background-color: #fff; border-radius: 3%; padding: 25.5px 15px 11.5px 15px;">
						<div style="padding-top: 7px;">
							<h2>プロフィールの編集</h2>
							<p style="font-size: 18px;">
								プロフィールを編集しよう
							</p>
						</div>
						<div class="form-group control-label" style="margin: 30px 0px; padding: 0px 16.5px;">
							<input type="submit" class="top-btn"  value="編集を完了する" style="width: 100%;" >
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 review animate-box">
					<div class="row review animate-box" style="background-color:#fff; border-radius: 3%;padding: 0px;">
						<div class="col-md-4 col-sm-4" >
							<div style="padding:6px 0px;">
								<input type="file" name="pic" class="form-control">
								<?php if (isset($error['image']) && $error['image'] == 'type') { ?>
									<p class="error">* jpg、png、gifのいずれかの拡張子を選んでください。</p>
								<?php } ?>
								<div style="padding:0px 27.49px;">
									<div id="bg" style="margin-left: 0px; width: 200px; height:200px;">
										<img id="wait" src="pic_profile/<?php echo $myprof['profile_pic'] ?>" width="200" height="200">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8 col-sm-8" style="padding-top:10px;">
							<h2>プロフィールの編集</h2>
							<label class="control-label" style="padding-top: 0px">ユーザーネーム</label>
							<input type="text" name="nickname" class="form-control" style="width: 100%;" value="<?php echo $myprof['nickname'] ?>">
							<label class="control-label" style="padding-top: 0px">メールアドレス</label>
							<input type="email" name="email" class="form-control" style="width: 100%;" value="<?php echo($myprof['email']) ?>">
							<p> ← 編集の完了ボタン</p>
						</div>
					</div>
				</div>
			</div>
			</form>
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
    document.getElementById("bg").innerHTML = "<p>変更後</p><img src='" + dataUrl + "' width='200' height='200' >";
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

