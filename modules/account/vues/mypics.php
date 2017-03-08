<div id="content-header">
Mes snapshots
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

  echo $content;

  include "global/content-mid.php";
  echo '<ul><span style="font-family: carringtonregular; font-size:32px; "><li><a href="index.php?module=account&action=modif">Editer le compte</a></li>';
  echo '<li><a href="index.php?module=account&action=mypics&p=1">Mes Snapshots</a></li></ul></span>';
  include "global/content-bottom.php";
?>
