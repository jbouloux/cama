<?php

// Chemins à utiliser pour accéder aux vues/modeles/librairies
$module = empty($module) ? !empty($_GET['module']) ? $_GET['module'] : 'index' : $module;
define('CHEMIN_VUE',    'modules/'.$module.'/vues/');
define('CHEMIN_MODELE', 'Models/');
define('CHEMIN_LIB',    'library/');
define('CHEMIN_IMG',    'pics/');
?>
