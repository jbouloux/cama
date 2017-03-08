<?php
  function get_comments($id_pic){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT t_users.id_user, login, comment, comment_date, id_comment FROM t_users INNER JOIN t_comments ON t_users.id_user = t_comments.id_user WHERE id_pic = :id_pic ORDER BY id_comment DESC");
    $requete->bindParam(':id_pic', $id_pic);
    $requete->execute();
    $result = $requete->fetchall();
    return ($result);
  }

  function set_comment($id_pic, $id_user, $comment){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("INSERT INTO t_comments (id_pic, id_user, comment, comment_date) VALUES (:id_pic, :id_user, :comment, NOW())");
    $requete->bindParam(':id_pic', $id_pic);
    $requete->bindParam(':id_user', $id_user);
    $requete->bindParam(':comment', $comment);
    $requete->execute();
  }

  function del_comment($id_comment){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("DELETE FROM t_comments WHERE id_comment = :id_comment");
    $requete->bindParam(':id_comment', $id_comment);
    $requete->execute();
  }
?>
