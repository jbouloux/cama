<header>
<div id="top_block">
	<a href="index.php" title="Accueil"><img id="top_banner" src="img/top-banner.png" height="140px" width="600px;"/></a>
	<a href="index.php" title="Accueil" style="text-decoration: none;"><div id="top_slogan">Yet another Snapshot App</div></a>
</div>
<div id="top_hr"><hr></div>
<div id="top_menu">

	<!-- MESSAGE ACCUEIL -->
	<div id="welcome-login">
	<?php
		if (isset($_SESSION["loggued_on_user"]) && !empty($_SESSION["loggued_on_user"]))
			echo 'Bienvenue ', $_SESSION["loggued_on_user"], " !";
	?>
	</div>

	<!-- ICONE MON COMPTE -->
	<?php
		if (isset($_SESSION["loggued_on_user"]) && !empty($_SESSION["loggued_on_user"]) && isset($_SESSION["user_id"]) && $_SESSION['user_id'] != 1){
	echo '<div class="block-icon" id="mon-compte"><a href="index.php?module=account&amp;action=modif" title="Mon compte" style="text-decoration:none; color:inherit;">
			<img class="sm-icon" src="/img/icons/user.png" height="64px" width="64px"><span style="display:block">Mon compte</span>
		</a></div>';
	}
	?>

	<!-- ICONE PANNEAU ADMIN -->
	<?php
	if (isset($_SESSION["loggued_on_user"]) && !empty($_SESSION["loggued_on_user"]) && isset($_SESSION["user_id"]) && $_SESSION['user_id'] == 1){
		echo '<div class="block-icon" id="admin-pan">
		<a href="" title="Panneau Admin" style="text-decoration:none; color:inherit;">
			<img class="sm-icon" src="/img/icons/admin.png" height="64px" width="64px"><span style="display:block">Admin</span>
		</a>
	</div>';
	}
	?>

	<!-- ICONE GALLERY -->
	<div class="block-icon" id="gallery-icon">
		<a title="Gallerie" style="color:inherit; text-decoration:none;" href="index.php?module=gallery&amp;action=gallery&amp;p=1">
			<img class="sm-icon" src="img/icons/gallery.png" height="64px" width="64px"><span style="display:block">Gallerie</span>
		</a>
	</div>

	<!-- ICONE SNAPSHOT -->
	<?php
	if (isset($_SESSION["loggued_on_user"]) && !empty($_SESSION["loggued_on_user"])){
		echo '<div class="block-icon" id="snapshot-icon">
		<a title="Snapshot" style="color:inherit; text-decoration:none;" href="index.php?module=snapshot&amp;action=snapshot">
			<img class="sm-icon" src="img/icons/snapshot.png" height="64px" width="64px"><span style="display:block">Snapshot</span>
		</a>
	</div>';
	}
	?>

	<!-- ICONE LOGIN -->
	<?php
	if (!isset($_SESSION["loggued_on_user"]) || empty($_SESSION["loggued_on_user"])){
		echo '<div class="block-icon" id="connect-icon">
		<img class="sm-icon" src="img/icons/login.png" title="Connexion" height="64px" width="64px"><span style="display:block">Connexion</span>
	</div>';
	}
	?>

	<!-- ICONE LOGOUT -->
	<?php
	if (isset($_SESSION["loggued_on_user"]) && !empty($_SESSION["loggued_on_user"])){
		echo '<div class="block-icon" id="logout-icon">
		<a title="Deconnexion" style="color:inherit; text-decoration:none;" href="index.php?module=members&amp;action=logout">
			<img class="sm-icon" src="img/icons/logout.png" height="64px" width="64px"><span style="display:block">Deconnexion</span>
		</a>
	</div>';
	}
	?>

	<!-- ICONE REGISTER -->
	<?php
	if (!isset($_SESSION["loggued_on_user"]) || empty($_SESSION["loggued_on_user"])){
		echo '<div class="block-icon" id="register-icon">
		<a href="index.php?module=members&amp;action=register" title="Inscription" style="text-decoration:none; color:inherit;">
			<img class="sm-icon" src="img/icons/register.png" height="64px" width="64px"><span style="display:block">Inscription</span>
		</a>
	</div>';
	}
	?>

</div>
<div><hr></div>

</header>
<div id="popup-connect">
	<form action="index.php?module=members&amp;action=login" method="post">
		Identifiant <br /><input style="width:200px;" type="text" name="login"/>
		<br /><br />
		Mot de passe <br /><input style="width:200px;" type="password" name="passwd" />
		<br /><br />
		<input type="submit" name="submit" value="Connexion" />
	</form>
</div>
