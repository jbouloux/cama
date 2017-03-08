<?php
  include CHEMIN_LIB.'generate_stuff.php';
  include CHEMIN_LIB.'bdd_get_gallery_pics.php';

  $nb_pic = 6;
  $p = isset($_GET['p']) ? $_GET['p'] : 1;
  $nb_page = generate_nb_page($nb_pic, $p);
  $content = $nb_page;
  $content .= "<div id='gallery-content'>";
  $pics = get_pics_per_page($p, $nb_pic);
  for ($i=0; $i < $nb_pic; $i++){
    if (isset($pics[$i]))
      $content .= generate_gallery_pic($pics[$i]);
  }
  $content .= "</div>";
  $content .= $nb_page;
  include CHEMIN_VUE.'gallery.php';
  echo '<script src="js/gallery.js"></script>';
?>
