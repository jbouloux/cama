<?php
if(!isset($_SESSION['user_id'])){
  header('Location: index.php');
  exit();
}
  include CHEMIN_LIB.'generate_stuff.php';
  include CHEMIN_LIB.'bdd_get_gallery_pics.php';
  include CHEMIN_LIB.'bdd_account.php';


  $nb_pic = 6;
  $p = isset($_GET['p']) ? $_GET['p'] : 1;
  $nb_page = generate_nb_page_account($nb_pic, $p, $_SESSION['user_id']);
  $content = $nb_page;
  $content .= "<div id='gallery-content'>";
  $pics = get_user_pics($p, $_SESSION['user_id'], $nb_pic);
  for ($i=0; $i < $nb_pic; $i++){
    if (isset($pics[$i]))
      $content .= generate_account_pic($pics[$i]);
  }
  $content .= "</div>";
  $content .= $nb_page;
  include CHEMIN_VUE.'mypics.php';
  echo '<script src="js/gallery.js"></script>';
?>
