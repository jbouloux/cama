<?php
  $snapshot = '<div id="snapshot-content">
  <video id="snapshot-video">
  <canvas id="snapshot-canvas"></canvas>
  </video><br><br>
  <button id="snapshot-button">Snapshot !</button>
  </div>
  <div id="snapshot-popup"><img id="snapshot-photo"></img>
  <form method="post" action="index.php?module=snapshot&amp;action=save_snap">
  <input type="hidden" id="form-snap" name="snap"></input>
  <input type="submit" value="Sauvegarder" />
  </form>
  <button id="snapshot-cancel">Annuler</button>
  </div>';
  include CHEMIN_VUE.'snapshot.php';
  echo '<script src="js/snapshot.js"></script>';
?>
