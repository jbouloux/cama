<?php

  include CHEMIN_LIB.'bdd_get_stuff.php';
  include CHEMIN_LIB.'bdd_like.php';
  include CHEMIN_LIB.'bdd_comment.php';

  function generate_comment($comment){
    $result = '<div class="gallery-comment-popup"';
    $result .= ';"><div class="comment-login"><span style="font-family: carringtonregular;font-size: 22px;">'.ucfirst($comment['login']);
    $result .= '</span> le '.$comment['comment_date']. ' : </div>';
    $result .= '<div class="gallery-comment-comment">'.$comment["comment"].'</div></div></br>';
    return ($result);
  }

  function generate_popup_pic($pic){
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

  function generate_gallery_pic($pic){
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
      <div><div class="owner" style="font-size:'.$font.';">'.$login.'</div></div>
    </div>
    </div>';

    $result = $picture['top'].CHEMIN_IMG.$pic['name'].'.png'.$picture['bottom'];
    $result .= generate_popup_pic($pic);
    return ($result);
  }

?>
