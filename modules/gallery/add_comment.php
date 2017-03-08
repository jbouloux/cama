<?php
  include CHEMIN_LIB.'bdd_comment.php';

  function back(){
    $page = !isset($_GET['p']) ? 1 : $_GET['p'];
    $gallery_path = 'index.php?module=gallery&action=gallery&p='.$page;
    header('Location: '.$gallery_path);
    exit();
  }

  if (isset($_POST['new_comment']) && $_POST['new_comment']){
    set_comment($_GET['id_pic'], $_SESSION['user_id'], $_POST['new_comment']);
  }
  back();
?>
