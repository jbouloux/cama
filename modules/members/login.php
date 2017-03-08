<?php
  include CHEMIN_LIB."bdd_check_login.php";
  if (($id = connect_user($_POST['login'], $_POST['passwd']))){
    if (($info = get_user_info($id))){
      $_SESSION['user_id'] = $id;
      $_SESSION['loggued_on_user'] = $info['login'];
      $_SESSION['email_user'] = $info['email'];
      $_SESSION['register_date'] = $info['register_date'];
      $_SESSION['access_right'] = $info['access_right'];
      include CHEMIN_VUE."login_success.php";
    }
  }
  else {
    include CHEMIN_VUE."login_failed.php";
  }
?>
