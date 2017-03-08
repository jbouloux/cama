<div id="content-header">
Inscription
</div>
<?php
  include "global/content-top.php";
  if (!empty($errors)){
      echo '<ul style="color:red">' , PHP_EOL;
      foreach($errors as $e){
        echo '<li>' , $e , '</li>' , PHP_EOL;
      }
      echo '</ul>', PHP_EOL;
  }
  echo $formulaire;
  include "global/content-mid.php";
  include "global/content-bottom.php";
?>
