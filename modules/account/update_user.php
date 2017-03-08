<?php
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
  exit();
}
$errors = array();
if (empty($_POST['oldpw']))
  array_push($errors, "Veuillez entrer votre mot de passe");
else if ($_POST['newpw'] != $_POST['conf_passwd'])
  array_push($errors, "Les nouveaux mots de passe entrés ne sont pas identiques");
if (!empty($errors))
  include CHEMIN_VUE.'modif.php';
else
  include 'bdd_check_update.php';

?>
