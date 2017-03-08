<?php
function generate_page($contenu){
  echo "<html>", PHP_EOL;
  include 'global/header.php';
  echo '<body>', '<div id="popup-blur"></div>','<div id="popup-blur-pic"></div>' , PHP_EOL;
  echo '<div id="page">', PHP_EOL;
  include 'global/top.php';

  echo $contenu;

  // Fin du code HTML
  include 'global/bottom.php';
  echo '</div>', PHP_EOL;
  echo "</body>", PHP_EOL , "</html>", PHP_EOL;

}
?>
