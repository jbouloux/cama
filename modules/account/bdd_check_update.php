<?php
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
  exit();
}
  include CHEMIN_LIB.'bdd_update_user.php';
  $errors_sql = update_user_info($_SESSION['user_id'], $_POST['email'], $_POST['oldpw'], $_POST['newpw']);
  if ($errors_sql === NULL){
    echo 'Modifications prises en compte !';
    $_SESSION['email_user'] = $_POST['email'];
  }

  else if ($errors_sql === FALSE){
    $errors[] = "Mot de passe erroné :(";
    include CHEMIN_VUE.'modif.php';
  }

else{
  if (23000 == $errors_sql[0]) {
    $i = 0;
    while ($errors_sql[$i] && is_numeric($errors_sql[$i]))
      $i++;
    if (!$errors_sql[$i]){
      $errors[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
      continue;
    }
    if (strpos($errors_sql[$i], "email"))
      $errors[] = "Cette adresse e-mail est déjà utilisée.";
    else
      $errors[] = "Erreur update SQL : doublon non identifié présent dans la base de données.";
  }
  else
    $errors[] = "Erreur ajout SQL : cas non traité (SQLSTATE =".$errors[0].")";
  include CHEMIN_VUE.'modif.php';
}
?>
