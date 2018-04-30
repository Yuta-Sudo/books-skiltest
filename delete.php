 <?php 
 require('function.php');
 login_check();
  $sql = 'UPDATE `book_recommends` SET `	book_del_flg` = 1  WHERE `recommend_id`=?';
  $delete = array($_GET['member_id']);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($delete); 
  header('Location: index.php');
  exit();}
   ?>