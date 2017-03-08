<?php

  include CHEMIN_LIB.'security.php';

  function connect_user($login, $passwd){
    $hash_passwd = hash_salt($passwd);
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT id_user FROM t_users WHERE login = :login AND passwd = :hash_passwd AND confirm_mail IS NULL");
    $requete->bindParam(':login', $login);
    $requete->bindParam(':hash_passwd', $hash_passwd);
    $requete->execute();
    if ($result = $requete->fetch(PDO::FETCH_ASSOC)){
      $requete->closeCursor();
      return ($result['id_user']);
    }
    return FALSE;
  }

  function get_user_info($id){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT login, email, register_date, access_right FROM t_users WHERE id_user = :id");
    $requete->bindParam(":id", $id);
    $requete->execute();
    if ($result = $requete->fetch(PDO::FETCH_ASSOC)){
      $requete->closeCursor();
      return ($result);
    }
    return FALSE;
  }
?>
