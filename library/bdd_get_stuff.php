<?php

  function get_login_from_id($id_user){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT login FROM t_users WHERE id_user = :id_user");
    $requete->bindParam(':id_user', $id_user);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    return ($result['login']);
  }

?>
