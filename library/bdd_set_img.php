<?php

  function bdd_get_max_pic(){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT MAX(id_pic) FROM t_pics");
    $requete->execute();
    $result = $requete->fetchall();
    return (isset($result[0]['MAX(id_pic)']) ? $result[0]['MAX(id_pic)'] : 0);
  }

  function bdd_add_new_img($id_user, $img, $format){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $file_name = strval($id_user).'-'.(strval(bdd_get_max_pic() + 1));
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
    file_put_contents(CHEMIN_IMG.$file_name.'.'.$format, $data);
    $requete = $pdo->prepare('INSERT INTO t_pics (name, format, id_owner) VALUES (:name, :format, :id_user)');
    $requete->bindParam(':name', $file_name);
    $requete->bindParam(':format', $format);
    $requete->bindParam(':id_user', $id_user);
    if ($requete->execute())
      return NULL;
    return $requete->errorInfo();
  }
?>
