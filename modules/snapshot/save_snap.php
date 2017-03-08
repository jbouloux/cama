<?php
  include CHEMIN_LIB.'bdd_set_img.php';
  if ($_POST['snap']){
    bdd_add_new_img($_SESSION['user_id'], $_POST['snap'], "PNG");
    include CHEMIN_VUE.'save_img_success.php';
  }
  else {
    include CHEMIN_VUE.'save_img_failed.php';
  }
?>
