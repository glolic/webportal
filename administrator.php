<?php


session_start();

?>
<!DOCTYPE html>
<html>
<?php
define('UPLPATH', 'slike/');

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['prijava'])){
		if (isset($_SESSION['$imePrijavljenogKorisnika'])) {
			unset($_SESSION['$imePrijavljenogKorisnika']);
			unset($_SESSION['$levelPrijavljenogKorisnika']);
		}
		$prijavaImeKorisnika = $_POST['imeKorisnika'];
		$prijavaLozinkaKorisnika = md5(htmlspecialchars($_POST['lozinkaKorisnika']));
		$dbc = mysqli_connect('localhost', 'root', '', 'portalko') or die('Error connecting to
		MySQL server.');
		
		$query = "SELECT username,password,level FROM users WHERE username = ? and password = ?";
		$stmt = mysqli_stmt_init($dbc);
		if (mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'ss', $prijavaImeKorisnika, $prijavaLozinkaKorisnika);
        	mysqli_stmt_execute($stmt);
        	mysqli_stmt_store_result($stmt);
     	}
		mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
		mysqli_stmt_fetch($stmt);
		if (mysqli_stmt_num_rows($stmt) > 0) {
			$uspjesnaPrijava = true;

			if($levelKorisnika == 2) {
				$korisnikJeAdministrator = true;
			}
			else {
				$korisnikJeAdministrator = false;
			}

			$_SESSION['$imePrijavljenogKorisnika'] = $imeKorisnika;
			$_SESSION['$levelPrijavljenogKorisnika'] = $levelKorisnika;
		} else {
			$uspjesnaPrijava = false;
		}
		mysqli_close($dbc);

	}
	else if(isset($_POST['administracija'])){
				if (isset($_POST['sakrijVijest'])) 
				{ 
					$sakrijVijest = $_POST['sakrijVijest'];
				} 
				if (isset($_POST['obrisiVijest'])) 
				{ 
					$obrisiVijest = $_POST['obrisiVijest'];
				}
				
				
				$idVijesti = $_POST['idVijesti'];
			
			if($obrisiVijest != null){
					$dbc = mysqli_connect('localhost', 'root', '', 'portalko') or die('Error connecting to
					MySQL server.');
					$query = "DELETE from vijesti WHERE id = '".$idVijesti."'";
					$result = mysqli_query($dbc, $query);
					mysqli_close($dbc);
			}
			else{
				$dbc = mysqli_connect('localhost', 'root', '', 'portalko') or die('Error connecting to
					MySQL server.');
					$query = "UPDATE vijesti SET sakrijVijest='".$sakrijVijest."' WHERE id = '".$idVijesti."'";
					$result = mysqli_query($dbc, $query);
					mysqli_close($dbc);
			}
	}
}
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
		
			
			if (($uspjesnaPrijava == true && $korisnikJeAdministrator == true)
			   || (isset($_SESSION['$imePrijavljenogKorisnika'])) && $_SESSION['$levelPrijavljenogKorisnika'] == 2){
			
			
			$dbc = mysqli_connect('localhost', 'root', '', 'portalko') or die('Error connecting to
			MySQL server.');
			
			$query = "SELECT * FROM vijesti";
			$result = mysqli_query($dbc, $query);
			
			while($row = mysqli_fetch_array($result)) {
			echo '<article id="vijest">';
						
							echo '<div class="naslovVijesti">';
								echo '<h1>' . $row['naslov'] . '</h1>' . '<br/>' . '<br/>' . '<br/>';
								
									echo '<form name= "promjenaProizvoda" action="administrator.php" method="POST">';
										echo '<input type="hidden"
												name="idVijesti"
												id="idVijesti"
												value="'.$row['id'].'"/>';
										if($row['sakrijVijest']==null){
											echo '<input type="checkbox"
														name="sakrijVijest"
														id="sakrijVijest"/> Sakrij Vijest?';
										}
										else{
										echo '<input type="checkbox"
														name="sakrijVijest"
														id="sakrijVijest" checked/> Sakrij Vijest?';
										}
										echo '<br />';
										echo '<input type="checkbox"
												name="obrisiVijest"
												id="obrisiVijest"/> Obriši vijest? <br/>';
								echo '<input type="submit" name="administracija" value="Promijeni">';
						echo '</form>';
					echo '</div>';	
					
			echo '</article>';
			}
			
			
			mysqli_close($dbc);
			// Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
			
			} 
			
			
			else if ($uspjesnaPrijava == true && $korisnikJeAdministrator == false) {
				echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator Portalka.</p>';
			}
			else if (isset($_SESSION['$imePrijavljenogKorisnika']) && $_SESSION['$levelPrijavljenogKorisnika'] == 1) {
				echo '<p>Bok ' . $_SESSION['$imePrijavljenogKorisnika'] .
					 '! Uspješno ste prijavljeni, ali niste administrator Portalka.</p>';
			} 
			else if ($uspjesnaPrijava == false ) {
				echo '<p>Niste uspješno prijavljeni,
					  molimo vas da se <a href="login.html">prijavite</a>
					  ili <a href="registracija.html">registrirate</a>.</p>';
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