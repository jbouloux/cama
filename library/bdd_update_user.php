<?php

  include CHEMIN_LIB.'security.php';

  function check_passwd($id, $passwd){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $hash_passwd = hash_salt($passwd);
    $requete = $pdo->prepare("SELECT COUNT(*) FROM t_users WHERE id_user = :id AND passwd = :hash_passwd");
    $requete->bindParam(':id', $id);
    $requete->bindParam(':hash_passwd', $hash_passwd);
    $requete->execute();
    return ($requete->columnCount() == 1);
  }

  function update_user_info($id, $email, $oldpw, $newpw){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    if (!check_passwd($id, $oldpw))
      return (FALSE);
    $hash_passwd = hash_salt($newpw);
    if ($newpw){
      $requete = $pdo->prepare("UPDATE t_users SET email = :email, passwd = :passwd WHERE id_user = :id");
      $requete->bindParam(':email', $email);
      $requete->bindParam(':passwd', $hash_passwd);
      $requete->bindParam(':id', $id);
    }
    else{
      $requete = $pdo->prepare("UPDATE t_users SET email = :email WHERE id_user = :id");
      $requete->bindParam(':email', $email);
      $requete->bindParam(':id', $id);
    }
    if ($requete->execute()){
      return (NULL);
    }
    return ($requete->errorInfo());
  }
?>
