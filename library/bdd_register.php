<?php

  include CHEMIN_LIB.'security.php';

  function send_activation_mail($confirm_mail, $email){
    $message_mail = '<html><head></head><body>
	   <p>Merci de vous être inscrit sur Camagru !</p>
	    <p>Veuillez cliquer sur <a href="'.$_SERVER['PHP_SELF'].'?module=members&amp;action=validate_account&amp;hash='.$confirm_mail.'">ce lien</a> pour activer votre compte !</p>
	     </body></html>';

    $headers_mail = 'From: camagru84@gmail.com' . "\r\n";
	  $headers_mail .= 'MIME-Version: 1.0'."\r\n";
	  $headers_mail .= 'Content-type: text/html; charset=utf-8'."\r\n";
    $headers_mail .= 'X-Mailer: PHP/' . phpversion();

	  // Envoi du mail
	  mail(trim($email), 'Inscription sur Camagru', $message_mail, $headers_mail);
  }

  function bdd_add_user($login, $email, $passwd){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("INSERT INTO t_users (login, passwd, email, confirm_mail, register_date)
      VALUES (:login, :passwd, :email, :confirm_mail, NOW())");
    $hash_passwd = hash_salt($passwd);
    $confirm_mail = hash_salt($email);
    $requete->bindParam(':login', $login);
    $requete->bindParam(':passwd', $hash_passwd);
    $requete->bindParam(':confirm_mail', $confirm_mail);
    $requete->bindParam(':email', $email);
    if ($requete->execute()){
      send_activation_mail($confirm_mail, $email);
      return NULL;
    }
    return $requete->errorInfo();
  }

  function bdd_validate_account($hash){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare('UPDATE t_users SET confirm_mail = NULL WHERE confirm_mail = :hash');
    $requete->bindParam(':hash', $hash);
    $requete->execute();
    return ($requete->rowCount() == 1);
  }
?>
