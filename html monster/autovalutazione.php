<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css-autovalutazione.css">
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="javascript/nav.js"></script>
    <link rel="stylesheet" href="css/css-nav.css">
    <title>Autovalutazione</title>
</head>
<?PHP 
session_start();
?>
<body>
    <!-- ?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoria = $_POST['categoria'];
            $nome = $_POST['nome'];
            $condizione = $_POST['condizione'];
            $pienavuota = $_POST['pienavuota'];

            echo "Categoria: $categoria <br>";
            echo "Nome: $nome <br>";
            echo "Condizione: $condizione <br>";
            echo "Piena o vuota: $pienavuota <br>";
        }
    ? -->
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
    <!--div-autovalutazione-->
    <div class="autovalutazione">
        <h2>Valuta la tua Monster</h2>
    </div>
     <!--div-autovalutazione-->

     <?php
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
        
        $queryCategoria = "SELECT DISTINCT C.Nome FROM Monster as M ";
        $queryCategoria .= "JOIN Categoria as C ON C.ID_categoria = M.Categoria_ID_categoria;";
        /*$queryPrezzoMaggiore = "SELECT DISTINCT C.Nome FROM Monster as M "
        $queryPrezzoMinore = "SELECT DISTINCT C.Nome FROM Monster as M "*/



    ?>
     <!--sezione-form-->
     <section>
        <div class="div-form">
            <form>
                <div class="div-testo">
                    <h2>Inserisci i dati della Monster</h2>
                </div> 
                    <select list="categoria" name="categoria">
                        <datalist id="categoria">
                            <?PHP
                                $ris = $con->query($queryCategoria) or die("Query Fallita!");
                                echo "<option value=''>Tutte le categorie</option>";
                                foreach($ris as $riga){
                                    echo $riga['Nome']."<br>";
                                    
                                    echo "<option value=".$riga['Nome'].">".$riga['Nome']."</option>";
                                }
                                

                                $con->close();
                            ?>
                        </datalist>
                    </select>
                    <select list="condizione" name="condizione" >
                        <datalist id="condizione">
                            <option disable selected>Seleziona lo stato</option>
                              <option value="Eccellente">Eccellente</option>
                              <option value="Ottimo">Ottimo</option>
                              <option value="Accettabile">Accettabile</option>
                              <option value="Pessimo">Pessimo</option>
                        </datalist>
                    </select>
                    <select list="pienavuota" name="pienavuota" >
                        <datalist id="pienavuota">
                            <option disable selected>Piena o vuota</option>
                            <option value="Piena">Piena</option>
                            <option value="Vuota">Vuota</option>
                        </datalist>
                    </select>
                    <?php
                    echo "<A href='AggiungiLattinaACollezione.php?ID_Monster=".$_GET['ID_Monster']."&piena=0'><button class='bottone-1'>Valuta</button></A>";
                    ?>
            </form>
        </div>
        <div class="div-form-center">

        </div>
        <div class="div-form-right">

        </div>
     </section>
     <!--end-sezione-form-->
     <!--footer-->
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