<head>
	<title>Camagru</title>
	<meta charset="utf-8" />
	<?php
		$loggued_on_user = isset($_SESSION['loggued_on_user']) ? $_SESSION['loggued_on_user'] : "";
		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
	?>
	<script>var user_id = "<?php echo $user_id ?>"</script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/pages.css" />
</head>
