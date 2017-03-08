<?php
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
  exit();
}
include CHEMIN_LIB.'bdd_account.php';

if (isset($_SESSION['user_id']) && $_SESSION['user_id']){
  if (bdd_access_account($_SESSION['user_id'])){
    bdd_delete_account($_SESSION['user_id']);
    $_SESSION = array();
    session_destroy();
    include CHEMIN_VUE.'delete_account_success.php';
  }
  else
    include CHEMIN_VUE.'delete_account_failed.php';
}
else
    include CHEMIN_VUE.'delete_account_failed.php';

?>
