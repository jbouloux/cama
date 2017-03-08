<?php
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
  exit();
}
include CHEMIN_LIB.'bdd_account.php';

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] && $_GET["pic"]){
  if (bdd_access_pic($_SESSION['user_id'], $_GET['pic'])){
    bdd_del_pic($_GET["pic"]);
    include CHEMIN_VUE.'delete_pic_success.php';
  }
  else
    include CHEMIN_VUE.'delete_pic_failed.php';
}
else
    include CHEMIN_VUE.'delete_pic_failed.php';

?>
