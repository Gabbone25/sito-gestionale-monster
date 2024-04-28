    <!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css-gestisci-account.css">
    <title>Il tuo account</title>
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
     <script src="javascript/nav.js"></script>
    <link rel="stylesheet" href="css/css-nav.css">
</head>
<?PHP 
session_start();
?>
<body>
<?php
    /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $nome_utente = $_POST['nome_utente'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo "Nome: $nome <br>";
        echo "Cognome: $cognome <br>";
        echo "Nome utente: $nome_utente <br>";
        echo "Email: $email <br>";
        echo "Password: $password <br>";
    }*/
    
?>
    <!--navbar-->
    <nav id="navbar">
            <div class="nav-left">
                <a href="index.php"><img src="img/logo-removebg-preview.png" alt="logo"></img></a>
            </div>
            <div class="nav-right">
                <ul>
					<li><a href="account.php">Account</a></li>
                    <li><a href="chisiamo.html">Chi siamo</a></li>
                    <?PHP 
                        if(isset($_SESSION['nome_utente'])){ 
                            echo "<li><a href='collezione.php'>Collezione</a></li>";
                        }
                    ?>
                    <li><a href="catalogo.php">Catalogo</a></li>
                    <li>
                        <form action="monster.php" method="get">
                            <div class="search-box">
                                <button class="btn-search"><i class="fas fa-search"></i></button>
                                <input type="text"  name="q" class="input-search" placeholder="Cerca..">
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="blocco"></div>
        <!--end-navbar-->
    <!--personal-section-->
    <header>
        <h2>Bentornato! <br><span>
            <?PHP
                $user = $_SESSION['nome_utente'];
                //dati per il db
                $servername = "localhost";
                $username = "root"; 
                $password = ""; 
                $dbname = "Monster";
                // Connessione al database
                $con = new mysqli($servername, $username, $password, $dbname);
            
                // Controllo della connessione
                if ($con->connect_error) {
                    die("Connessione fallita: " . $con->connect_error);
                } else {
                    //echo "Connessione al database riuscita!";
                }
                $query = "SELECT U.Nome, U.Cognome, U.Nome_Utente, U.Email, U.Password ";
                $query .= "FROM utente_registrato as U ";
                $query .= "WHERE U.Nome_Utente = '".$user."';"; 
 

                $ris = $con->query($query);

                // Verifica se la query ha restituito dei risultati
                if ($ris === false) {
                    // La query ha restituito un errore
                    die("Query Fallita: " . $con->error);
                } else {
                    // La query è stata eseguita correttamente
                    // Qui si estrae la query
                    $row = $ris->fetch_assoc();
                    
                    $nome = $row['Nome'];
                    $cognome = $row['Cognome'];
                    $nome_utente = $row['Nome_Utente'];
                    $email = $row['Email'];
                    $password = $row['Password'];
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome1 = $_POST['nome'];
                $cognome1 = $_POST['cognome'];
                $nome_utente1 = $_POST['nome_utente'];
                $email1 = $_POST['email'];
                $password1 = $_POST['password'];
        
                /*echo "Nome: $nome <br>";
                echo "Cognome: $cognome <br>";
                echo "Nome utente: $nome_utente <br>";
                echo "Email: $email <br>";
                echo "Password: $password <br>";*/
                $querydati = "UPDATE utente_registrato ";
                $querydati .= "SET Nome = '$nome1', Cognome = '$cognome1', Nome_utente = '$nome_utente1', Email = '$email1', Password = '$password1' ";
                $querydati .= "WHERE nome_utente = '".$user."';";                
                $ris = $con->query($querydati);
                //echo $querydati;

                $query2 = "SELECT U.Nome, U.Cognome, U.Nome_Utente, U.Email, U.Password ";
                $query2 .= "FROM utente_registrato as U ";
                $query2 .= "WHERE U.Nome_Utente = '". $nome_utente1."';"; 
 

                $ris = $con->query($query2);

                // Verifica se la query ha restituito dei risultati
                if ($ris === false) {
                    // La query ha restituito un errore
                    die("Query Fallita: " . $con->error);
                } else {
                    // La query è stata eseguita correttamente
                    // Qui si estrae la query
                    $row = $ris->fetch_assoc();
                    
                    $nome = $row['Nome'];
                    $cognome = $row['Cognome'];
                    $nome_utente = $row['Nome_Utente'];
                    $email = $row['Email'];
                    $password = $row['Password'];
                     

                    //POP-UP
                }


            }
        ?>
        <?PHP 
            if(isset($_SESSION['nome_utente'])) 
            {
                echo $_SESSION['nome_utente'];
            }
		?>
        </span></h2>
    </header>
    <!--end-personal-section-->
    <!--Dati-utente-section-->
    <section class="dati-utente">
        <div class="block-per-il-testo">
            <div class="filtro-1">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <div class="dropdown-menu">
                  <a href="logout.php">Esci</a>
                </div>
              </div>
        </div>
        <div class="header-left">
        <?PHP
            if(!isset($_POST['nome_utente']))
            {
        ?>
            <form action="<?php ($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="div-dati">
                        <input type="text" name="nome" placeholder="il tuo Nome" class="input-dati" value="<?php echo $nome ?>">
                        <input type="text" name="cognome" placeholder="il tuo Cognome" class="input-dati" value="<?php echo $cognome; ?>">
                    </div>
                    <div class="div-dati">
                        <input type="text" name="nome_utente" placeholder="il tuo nome utente" value="<?php echo $nome_utente ?>">
                    </div>
                    <div class="div-dati">
                        <input type="email" name="email" placeholder="la tua email" value="<?php echo $email ?>">
                    </div>
                    <div class="div-dati">
                        <input type="password" name="password" placeholder="la tua password" value="<?php echo $password ?>">
                    </div>
                    <button>Aggiorna dati</button>
            </form>
            <?PHP
				}
				else{
                    ?>
                    <span class="registrazione-good">Dati aggiornati correttamente</span>
                    <a href="gestisci-account.php"><button>Controlla</button>

                    <?PHP
                }
            ?>
        </div>
        
        <div class="header-center">
            <div></div>
        </div>
        <div class="header-right">
            <div>
                <h2><a href="collezione.php">Scopri la tua<br>Collezione</a></h2>
            </div>
        </div>
    </section>
    <!--end-Dati-utente-section-->
     <!--Footer-->
     <footer>
        <div class="footer-left">
            <img src="img/logo-cn.png" alt="logo">
        </div>
        <div class="footer-center">
            <span class="title-footer">Contatti utili</span>
            <ul class="ul-footer">
                <li>cnmonster@gabbofilo.com</li>
                <li>Via Cunacotra 2, Milano</li>
                <li>Via Filo Gabbone 10, Torino</li>
                <li>02 0103040</li>
            </ul>
        </div>
        <div class="footer-right">
            <span class="title-footer">Link utili</span>
                <ul class="ul-footer">
                 <li>Home</li>
                 <li>Chi siamo</li>
                 <li>Collezione</li>
                 <li>Catalogo</li>
            </ul>
        </div>
    </footer>
    <!--End-Footer-->
</body>
</html>