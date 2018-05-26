<!DOCTYPE html>
<html>

<?php

$punoImeKorisnika = $_POST['punoImeKorisnika'];
$imeKorisnika = $_POST['imeKorisnika'];
$lozinkaKorisnika = md5(htmlspecialchars($_POST['lozinkaKorisnika']));

// sql injection!!
$dbc = mysqli_connect('localhost', 'root', '', 'portalko') or die('Error connecting to
MySQL server.');
$sql = "INSERT INTO users (username, password, name)
		VALUES (?, ?, ?)";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt, 'sss', $imeKorisnika, $lozinkaKorisnika, $punoImeKorisnika);
    mysqli_stmt_execute($stmt);
	$registriranKorisnik = true;
}
mysqli_close($dbc);
?>

<head>
	 <meta charset="UTF-8">
	  <meta name="description" content="Web portal">
	 <meta name="keywords" content="HTML,CSS,XML,JavaScript, PHP">
	 <meta name="author" content="Goran Lolić">
	 <link rel="stylesheet" href="style.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>
<body>

	<header>
		<h1> Portalko </h1>
		<p> Vaš portal za vijesti </p>
	</header>

	<nav class="navbar navbar-inverse">
	
	<div class="container">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		 <li><a href="index.php">Početna</a></li>
		  <li > <a href="unos.html">Unos </a></li>
		   <li> <a href="login.html"> Login </a> </li>
		   <li> <a href="registracija.html"> Registracija </a> </li>
		</ul>
	  </div>
	  </div>
	</nav>
		<main>
		<div class="container">
		<?php
				if($registriranKorisnik == true) {
					echo '<p>Korisnik je uspješno registriran!</p>';
				} else {
					echo '<p>Korisnik nije uspješno registriran!</p>';
				}
			?>
		
		</div>
		</main>
	<footer>
	<div class="container">
		<p> Napravio Goran Lolić, 2018. god.<br/> </p>
	</div>
	</footer>
</body>

</html>