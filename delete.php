 <?php
	require('dbconnect.php');
	session_start();
	require('func.php');
	login_check();
	$sql = 'UPDATE `book_recommends` SET `book_del_flg` = 1  WHERE `recommend_id`=?';
	$delete = array($_GET['id']);
	$stmt = $dbh->prepare($sql);
	$stmt->execute($delete); 
	header('Location: home.php');
	exit();
?>