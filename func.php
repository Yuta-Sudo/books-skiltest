<?php
  function login_check() {
  if (isset($_SESSION['id']) && $_SESSION['time'] + 3600*24*7 > time()) {
    $_SESSION['time'] = time();
  } else {
  header('Location: index.php');
  exit;
    }
  }
?>