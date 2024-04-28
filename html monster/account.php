<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
    <title>Registrati</title>
    <link rel="stylesheet" href="css/css-account.css">
    
    <!--prova-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<?PHP 
session_start();
?>
<body>
	<header>
        <a href="index.php"><i class="fa-solid fa-arrow-left-long back-home fa-lg"></i></a>
        <div class="header-left">
            <img src="img/logo-removebg-preview.png" alt="logo">
			<?PHP
				if(!isset($_POST['email'])) {
			?>
				<form action="<?php ($_SERVER['REQUEST_URI']) ?>" method="POST">
					<div class="div-dati">
						<i class="fa-solid fa-signature"></i>
						<input type="text" name="nome" placeholder="Nome" class="input-dati">
						<input type="text" name="cognome" placeholder="Cognome" class="input-dati">
					</div>
					<div class="div-dati">
						<i class="fa-regular fa-user"></i>
						<input type="Text" name="nome_utente" placeholder="Nome utente">
					</div>
					<div class="div-dati">
						<i class="fa-regular fa-envelope"></i>
						<input type="email" name="email" placeholder="Email">
					</div>
					<div class="div-dati">
						<i class="fa-solid fa-unlock-keyhole"></i>
						<input type="password" name="password" placeholder="Password">
					</div>
					<button type="submit">Registrati</button> 
				</form>
			<?PHP
				}
				else{
					if(($_POST['password']!=NULL) && ($_POST['email']!=NULL)) //Ovviamente questo controllo dovrebbe essere più strutturato
					{						
						$con = new mysqli("localhost", "root", "", "monster");
						if(mysqli_connect_errno())
						{
							echo("Connessione Fallita: ".mysqli_connect_errno()."<br>");
							exit();
						}
						$sql ="insert into utente_registrato (Nome, Cognome, Nome_Utente, Email, Password)";
						$sql .=" values('".$_POST['nome']."', '".$_POST['cognome']."', '".$_POST['nome_utente']."',";
						$sql .=" '".$_POST['email']."', '".	($_POST['password'])."');";
						$ris = $con->query($sql) or die("Errore: ".$sql."<br>".$con->error."<br>");
						$con->close();
						//echo"<br><br><a href='Accedi.php'>Registrazione andata a Buon Fine. Torna al Login</a><br>";
						?>
						<span class="registrazione-good">Registrazione effettuata correttamente</span>
						<a href="accedi.php"><button>Accedi</button></a>
						<?PHP
					}
					else{
						?>
							<span class="login-fallito">Registrazione fallita, inserisci almeno email e password</span>
							<a href="account.php"><button>Registrati</button></a>
						<?PHP
					}
				}
			?>
            <div class="accedi-text">- Oppure<a href="accedi.php">accedi</a>-</div>
        </div>
        <div class="header-center">
            <div></div>
        </div>
        <div class="header-right">
            <img src="img/foto-registrati.png" alt="team">
        </div>
    </header>
</body>
</html>