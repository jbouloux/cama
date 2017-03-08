<?php

function get_value($name){
  if (isset($_POST[$name]))
    return ($_POST[$name]);
  else
    return ("");
}

$formulaire = '<form id="register-form" action="index.php?module=members&amp;action=register" method="post">
  Identifiant
  </br>
  <input type="text" name="login" value="' . get_value('login') . '" maxlength="32"/>
  </br></br>
  Adresse email
  </br>
  <input type="email" name="email" value="' . get_value('email') . '"/>
  </br></br>
  Mot de passe
  </br>
  <input type="password" name="passwd"/>
  </br></br>
  Confirmation mot de passe
  </br>
  <input type="password" name="conf_passwd"/>
  </br>
  </br>
  <input type="submit" name="submit" value="Valider" />
</form>';

if (isset($_POST['submit']) && $_POST['submit'] == "Valider")
  include 'create_user.php';
else
  include CHEMIN_VUE.'register.php'

?>
