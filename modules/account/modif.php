<?php
  if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit();
  }
$formulaire = '<form id="modif-form" action="index.php?module=account&amp;action=modif" method="post">
  Adresse email
  </br>
  <input type="email" name="email" value="' . $_SESSION['email_user'] . '"/>
  </br></br>
  Mot de passe actuel
  </br>
  <input type="password" name="oldpw"/>
  </br></br>
  Nouveau mot de passe
  </br>
  <input type="password" name="newpw"/>
  </br>
  </br>
  Confirmation du nouveau mot de passe
  </br>
  <input type="password" name="conf_passwd"/>
  </br>
  </br>
  <input type="submit" name="submit" value="Valider" />
</form>';
$formulaire .= '<a href="index.php?module=account&action=delete_account" onclick="return confirm(\'Etes-vous sûr ?\');"><button>Supprimer le compte</button></a>';

if (isset($_POST['submit']) && $_POST['submit'] == "Valider")
  include 'update_user.php';
else
  include CHEMIN_VUE.'modif.php';
?>
