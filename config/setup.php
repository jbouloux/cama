<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=db_camagru;charset=utf8', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		try
		{
			$bdd = new PDO('mysql:host=localhost;charset=utf8;', 'root', '');
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
				echo 'Échec lors de la connexion : ' . $e->getMessage();
				exit;
		}
		if (isset($_POST['submit']))
		{
			$sql = file_get_contents("setup.sql");
			$sql_array = explode(";", $sql);
			foreach ($sql_array as $val)
			{
				$bdd->query($val);
			}
		}
	}

?>

<form action="setup.php" method="post">
	<input type="submit" name="submit" id="" value="INSTALLER LA BDD !" />
</form>
