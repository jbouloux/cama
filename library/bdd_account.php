<?php

function count_nb_pages_account($nb_pic, $id_user){
  try {
  $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo 'Échec lors de la connexion : ' . $e->getMessage();
    exit;
  }
  $requete = $pdo->prepare("SELECT COUNT(*) AS total FROM t_pics WHERE id_owner = :id_user");
  $requete->bindParam(':id_user', $id_user);
  $requete->execute();
  $total = $requete->fetch(PDO::FETCH_ASSOC);
  return ($total['total']);
}

  function get_user_pics($page, $user_id, $nb_pic){
    $first = ($page-1)*$nb_pic;
    try {
    $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo 'Échec lors de la connexion : ' . $e->getMessage();
      exit;
    }
    $requete = $pdo->prepare("SELECT id_pic, name, nb_like, id_owner FROM t_pics WHERE id_owner = :id_user ORDER BY id_pic DESC LIMIT :first , :nb_pic");
    $requete->bindValue(':id_user', $user_id);
    $requete->bindValue(':first', $first, PDO::PARAM_INT);
    $requete->bindValue(':nb_pic', $nb_pic, PDO::PARAM_INT);
    $requete->execute();
    $result = $requete->fetchAll();
    return ($result);
  }

  function generate_nb_page_account($nb_pic, $actual_page, $id_user){
    $block = '<div id="nb_page">'.PHP_EOL;
    $nb_page = ceil(count_nb_pages_account($nb_pic, $id_user)/$nb_pic);
    if ($actual_page > $nb_page){
      header('Location: index.php?module=account&action=mypics&p=1');
      exit();
    }
    for ($i = 1; $i <= $nb_page; $i++){
      if ($i == $actual_page)
        $block .= "<a href='index.php?module=account&amp;action=mypics&amp;p=".$i."' ><strong><span style='font-size: 34px;'>".$i."</span></strong></a>".PHP_EOL;
      else
        $block .= "<a href='index.php?module=account&amp;action=mypics&amp;p=".$i."' ><span style='font-size: 24px;'>".$i."</span></a>".PHP_EOL;
    }
    $block .= "</div>".PHP_EOL;
    return ($block);
  }

    function generate_comment_account($comment){
      $result = '<div class="gallery-comment-popup"';
      $result .= ';"><div class="comment-login"><span style="font-family: carringtonregular;font-size: 22px;">'.ucfirst($comment['login']);
      $result .= '</span> le '.$comment['comment_date']. ' : </div>';
      $result .= '<div class="gallery-comment-comment">'.$comment["comment"].'</div></div></br>';
      return ($result);
    }

    function generate_popup_pic_account($pic){
      $comments = get_comments($pic['id_pic']);
      $result = '<div class="gallery_popup_pic" id="'.$pic['name'].'">';
      $result .= '<img class="gallery-big-pic" src="'.CHEMIN_IMG.$pic['name'].'.png" />';
      $result .= '<div class="gallery-comment-content">';
      foreach ($comments as $elem){
        $result .= generate_comment($elem);
      }
      $result .= '</div>';
      $result .= '<form class="form-comment" method="post" action="index.php?module=gallery&action=add_comment&p='.$_GET['p'].'&id_pic='.$pic['id_pic'].'">
      <input class="form-comment-input" name="new_comment" type="text" /><input type="submit" name="submit" value="Envoyer" /></form></div>';
      return ($result);
    }

    function generate_account_pic($pic){
      $login = ucfirst(get_login_from_id($pic['id_owner']));
      $len = strlen($login);
      $font = 28 - round($len / 2);
      if (isset($_SESSION['user_id']))
        $user_like = bdd_is_like($pic['id_pic'], $_SESSION['user_id']);
      else
        $user_like = FALSE;
      $like_path = 'index.php?module=gallery&action=like&p='.$_GET["p"].'&pic='.$pic['id_pic'];
      $picture['top'] = '<div class="gallery-content-pic">'.PHP_EOL.'<img class="gallery-pic" src="';
      $picture['bottom'] = '" onclick=\'togglePhotoPopup("'.$pic['name'].'")\'/>
      <div class="gallery-block-icon">
        <a href="'.$like_path.'"><div><div class="';
        $picture['bottom'] .= $user_like === FALSE ? 'gallery-like' : 'gallery-liked';
        $picture['bottom'].= '">'.$pic['nb_like'].'</div></div></a>'.
        '<img class="gallery-comment" src="img/icons/comment.png"/>
        <div><a href="index.php?module=account&action=del_pic&pic='.$pic['id_pic'].'&p='.$_GET['p'].'" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer ce Snapshot ?\');"><img src="img/icons/delete.png" class="del-pic-icon"></div></a>
      </div>
      </div>';

      $result = $picture['top'].CHEMIN_IMG.$pic['name'].'.png'.$picture['bottom'];
      $result .= generate_popup_pic($pic);
      return ($result);
    }

    function bdd_del_pic($id_pic){
      try {
      $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
        echo 'Échec lors de la connexion : ' . $e->getMessage();
        exit;
      }
      $requete_a = $pdo->prepare('DELETE FROM t_pics WHERE id_pic = :id_pic');
      $requete_a->bindParam(':id_pic', $id_pic);
      $requete_a->execute();
      $requete_b = $pdo->prepare('DELETE FROM t_comments WHERE id_pic = :id_pic');
      $requete_b->bindParam(':id_pic', $id_pic);
      $requete_b->execute();
    }

    function bdd_access_pic($id_user, $id_pic){
      if ($id_user === 1)
        return TRUE;
      try {
      $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
        echo 'Échec lors de la connexion : ' . $e->getMessage();
        exit;
      }
      $requete = $pdo->prepare('SELECT id_owner FROM t_pics WHERE id_pic = :id_pic');
      $requete->bindParam(':id_pic', $id_pic);
      $requete->execute();
      $result = $requete->fetchAll();
      if (isset($result[0]['id_owner']) && $result[0]['id_owner'] === $id_user)
        return TRUE;
      return FALSE;
    }

    function bdd_access_account($id_user){
      if ($id_user === 1)
        return TRUE;
      try {
      $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
        echo 'Échec lors de la connexion : ' . $e->getMessage();
        exit;
      }
      $requete = $pdo->prepare('SELECT id_user FROM t_users WHERE id_user = :id_user');
      $requete->bindParam(':id_user', $id_user);
      $requete->execute();
      $result = $requete->fetchAll();
      if (isset($result[0]['id_user']) && $result[0]['id_user'] === $id_user)
        return TRUE;
      return FALSE;
    }

    function del_all_pics_user($id_user){
      try {
      $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
        echo 'Échec lors de la connexion : ' . $e->getMessage();
        exit;
      }
      $requete = $pdo->prepare('DELETE FROM t_pics WHERE id_owner = :id_user');
      $requete->bindParam(':id_user', $id_user);
      $requete->execute();
    }

    function bdd_delete_account($id_user){
      try {
      $pdo = new PDO(SQL_SERVER, SQL_USERNAME, SQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
        echo 'Échec lors de la connexion : ' . $e->getMessage();
        exit;
      }
      $requete = $pdo->prepare('DELETE FROM t_users WHERE id_user = :id_user');
      $requete->bindParam(':id_user', $id_user);
      $requete->execute();
      del_all_pics_user($id_user);
    }
  ?>
