<?php
  include CHEMIN_LIB.'bdd_register.php';

  if (!empty($_GET['hash'])){
    if (bdd_validate_account($_GET['hash'])){
      include CHEMIN_VUE.'account_activated.php';
    }
    else {
      include CHEMIN_VUE.'error_account_activation.php';
    }
  }
  else {
    include CHEMIN_VUE.'error_account_activation.php';
  }
?>
