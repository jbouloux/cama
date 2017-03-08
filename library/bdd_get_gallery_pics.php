<?php

  function count_nb_pages($nb_pic){
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT COUNT(*) AS total FROM t_pics");
    $requete->execute();
    $total = $requete->fetch(PDO::FETCH_ASSOC);
    return ($total['total']);
  }

  function get_pics_per_page($page, $nb_pic){
    $first = ($page-1)*$nb_pic;
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT id_pic, name, nb_like, id_owner FROM t_pics ORDER BY id_pic DESC LIMIT :first , :nb_pic");
    $requete->bindValue(':first', $first, PDO::PARAM_INT);
    $requete->bindValue(':nb_pic', $nb_pic, PDO::PARAM_INT);
    $requete->execute();
    $result = $requete->fetchAll();
    return ($result);
  }

  function generate_nb_page($nb_pic, $actual_page){
    $block = '<div id="nb_page">'.PHP_EOL;
    $nb_page = ceil(count_nb_pages($nb_pic)/$nb_pic);
    if ($actual_page > $nb_page){
      header('Location: index.php?module=gallery&action=gallery&p=1');
      exit();
    }
    for ($i = 1; $i <= $nb_page; $i++){
      if ($i == $actual_page)
        $block .= "<a href='index.php?module=gallery&amp;action=gallery&amp;p=".$i."' ><strong><span style='font-size: 34px;'>".$i."</span></strong></a>".PHP_EOL;
      else
        $block .= "<a href='index.php?module=gallery&amp;action=gallery&amp;p=".$i."' ><span style='font-size: 24px;'>".$i."</span></a>".PHP_EOL;
    }
    $block .= "</div>".PHP_EOL;
    return ($block);
  }
?>
