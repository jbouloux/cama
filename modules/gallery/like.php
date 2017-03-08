<?php
  include CHEMIN_LIB.'bdd_like.php';

  function back(){
    $page = !isset($_GET['p']) ? 1 : $_GET['p'];
    $gallery_path = 'index.php?module=gallery&action=gallery&p='.$page;
    header('Location: '.$gallery_path);
    exit();
  }

  if (!isset($_SESSION["user_id"])){
    back();
  }
  if (bdd_is_like($_GET['pic'], $_SESSION['user_id']) === TRUE)
    bdd_dislike($_GET['pic'], $_SESSION['user_id']);
  else
    bdd_like($_GET['pic'], $_SESSION['user_id']);
  back();

?>
