<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <link rel="stylesheet" href="css/css-account.css">  
    <!--prova-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
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
				if(!isset($_POST['nome_utente']))
				{
			?>
					<form action="<?php ($_SERVER["PHP_SELF"]); ?>" method="POST">
						<div class="div-dati">
							<i class="fa-regular fa-user"></i>
							<input type="text"  name="nome_utente" placeholder="Nome utente">
						</div>
						<div class="div-dati">
							<i class="fa-solid fa-unlock-keyhole"></i>
							<input type="password"  name="password"placeholder="Password">
						</div>
						<button>Login</button>
					</form>
					<div class="accedi-text">- Oppure<a href="account.php">registrati</a>-</div>
			<?PHP
				}
				else{
					$user=$_POST['nome_utente'];
					$pwd=($_POST['password']);
					$con = new mysqli("localhost", "root", "", "monster");
					if(mysqli_connect_errno())
					{
						echo("Connessione Fallita: ".mysqli_connect_errno()."<br>");
						exit();
					}
					$sql="select ID_Utente, Nome_Utente, Password from utente_registrato where Nome_Utente='".$user."';";
					$ris = $con->query($sql);
					if($ris->num_rows)
					{
						//in caso positivo, verifica la corrispondenza Login/Password
						$row = $ris->fetch_assoc();//Guardare da qui in poi!!!!!!
						if($row["Password"] == $pwd) 
						{
							echo"<span class='benvenuto'> Benvenuto ".$row['Nome_Utente']."</span>"."<br>";
							
							$_SESSION['nome_utente'] = $user;	//correggere col cookie di sessione		
							$_SESSION['ID_Utente'] = $row["ID_Utente"];
							// Qui riconosce gli amministratori
							$sqlisAdmin =  "SELECT U.Nome_Utente ";
							$sqlisAdmin .= "FROM isAmministratore as A ";
							$sqlisAdmin .= "JOIN utente_registrato as U ON A.Utente_Registrato_ID_Utente = U.ID_Utente ";
							$sqlisAdmin .= "WHERE U.Nome_Utente = '".$user."';";
							
							$ris = $con->query($sqlisAdmin) or die("Query Fallita!");
							if($ris->num_rows == 1){
								echo "Admin";
								$_SESSION['Admin'] = true;								
							}
							// Se ho un'occorrenza dovrebbe essere admin
							// Provare e Continuare dopo aver riconosciuto l'amministratore
							echo"<a href='collezione.php'><button>Collezione</button></a>";
						}
						else
						{
							echo"<br><br><span href='accedi.php' class='login-fallito'> password sbagliata, ritenta</span><br>";
						
						?>
							<a href="accedi.php"><button>Riprova</button></a>
							<div class="accedi-text">- Oppure<a href="account.php">registrati</a>-</div>	
						<?PHP
						}
					}
					else
					{
							//se non riconosce il login, elimina le variabili ricevute dal FORM, propone un iscrizione al sistema
							unset($_POST['nome_utente']);
							unset($_POST['password']);
							echo"<br><br><span href='accedi.php' class='login-fallito'>Login Fallito, ritenta</span><br>";
					?>
						<a href="accedi.php"><button>Riprova</button></a>
						<div class="accedi-text">- Oppure<a href="account.php">registrati</a>-</div>
					<?PHP
						
					}
					$con->close();
				}
			?>
        </div>
        <div class="header-center">
            <div></div>
        </div>
        <div class="header-right">
            <img src="img/Login-amico.png" alt="team">
        </div>
    </header>   
</body>
</html>