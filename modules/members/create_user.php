<?php
$errors = array();
if (empty($_POST['login']))
  array_push($errors, "Veuillez spécifier un identifiant");
if (empty($_POST['email']))
  array_push($errors, "Veuillez spécifier une adresse email");
if (empty($_POST['passwd']))
  array_push($errors, "Veuillez spécifier un mot de passe");
else if ($_POST['passwd'] != $_POST['conf_passwd'] || empty($_POST['conf_passwd']))
  array_push($errors, "Les mots de passe entrés ne sont pas identiques");
if (!empty($errors))
  include CHEMIN_VUE.'register.php';
else
  include 'bdd_check_register.php';

?>
