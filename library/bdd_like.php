<?php

function bdd_is_like($id_pic, $user_id){
  try {
  $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo 'Échec lors de la connexion : ' . $e->getMessage();
    exit;
  }
  $requete = $pdo->prepare("SELECT COUNT(*) FROM t_likes WHERE id_pic = :id_pic AND id_user = :id_user");
  $requete->bindParam(':id_pic', $id_pic);
  $requete->bindParam(':id_user', $user_id);
  $requete->execute();
  $result = $requete->fetchall();
  if (isset($result[0]['COUNT(*)']) && $result[0]['COUNT(*)'] != 0)
    return (TRUE);
  else
    return (FALSE);
}

function bdd_like($id_pic, $id_user){
  try {
  $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo 'Échec lors de la connexion : ' . $e->getMessage();
    exit;
  }
  $requete_a = $pdo->prepare("UPDATE t_pics SET nb_like = nb_like + 1 WHERE id_pic = :id_pic");
  $requete_a->bindParam(':id_pic', $id_pic);
  $requete_a->execute();
  $requete_b = $pdo->prepare("INSERT INTO t_likes (id_user, id_pic) VALUES (:id_user, :id_pic)");
  $requete_b->bindParam(':id_user', $id_user);
  $requete_b->bindParam(':id_pic', $id_pic);
  $requete_b->execute();
  return $requete_b->errorInfo();
}

function bdd_dislike($id_pic, $id_user){
  try {
  $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo 'Échec lors de la connexion : ' . $e->getMessage();
    exit;
  }
  $requete_a = $pdo->prepare("UPDATE t_pics SET nb_like = nb_like - 1 WHERE id_pic = :id_pic");
  $requete_a->bindParam(':id_pic', $id_pic);
  $requete_a->execute();
  $requete_b = $pdo->prepare("DELETE FROM t_likes WHERE id_user = :id_user AND id_pic = :id_pic");
  $requete_b->bindParam(':id_user', $id_user);
  $requete_b->bindParam(':id_pic', $id_pic);
  $requete_b->execute();
  return $requete_b->errorInfo();
}
?>
