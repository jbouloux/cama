<?php
  include CHEMIN_LIB.'bdd_register.php';
  if (!($errors_sql = bdd_add_user($_POST['login'], $_POST['email'], $_POST['passwd']))){
    echo 'Inscription réussie ! Merci de cliquer sur le lien que vous allez recevoir par email d\'ici quelques secondes afin d\'activer votre compte.';
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
    if (strpos($errors_sql[$i], "login"))
      $errors[] = "Ce nom d'utilisateur est déjà utilisé.";
    else if (strpos($errors_sql[$i], "email"))
      $errors[] = "Cette adresse e-mail est déjà utilisée.";
    else
      $errors[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
  }
  else
    $errors[] = "Erreur ajout SQL : cas non traité (SQLSTATE =".$errors[0].")";
  include CHEMIN_VUE.'register.php';
}
?>
