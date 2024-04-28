<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="css/css-catalogo.css">
    <!--prova-->
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="javascript/nav.js"></script>
    <link rel="stylesheet" href="css/css-nav.css">
</head>
<body>
<?PHP 
session_start();
?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['scelte'])) {
            $scelte_selezionate = $_POST['scelte'];
            foreach($scelte_selezionate as $scelta) {
                echo "Scelta selezionata: $scelta <br>";
            }
        }
    }
?>
<?php
			// vuoto
			if($_POST){
				$query = "SELECT M.ID_Monster, M.Nome, M.Colore, M.Prezzo, M.Quantita_Liquido, M.Descrizione_Generale, M.Categoria_ID_categoria, M.foto, C.Nome as Categoria ";
                $query .= "FROM Monster as M ";
                $query .= "JOIN Categoria as C ON C.ID_categoria = M.Categoria_ID_categoria";
                if($_POST["Categoria"]) $query .= " AND C.Nome = '".$_POST["Categoria"]."' ";
                if($_POST["Prezzo"] == "prezzo-crescente") {
                    $query .= " ORDER BY M.Prezzo ASC";
                } elseif($_POST["Prezzo"] == "prezzo-decrescente") {
                    $query .= " ORDER BY M.Prezzo DESC";
                }
                

			}
			else{
				$query = "SELECT M.ID_Monster, M.Nome, M.Colore, M.Prezzo, M.Quantita_Liquido, M.Descrizione_Generale, M.Categoria_ID_categoria, M.foto, C.Nome as Categoria ";
                $query .= "FROM Monster as M ";
                $query .= "JOIN Categoria as C ON C.ID_categoria = M.Categoria_ID_categoria;";    
			
			}	
			
			//echo $query;        
		
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
    <!--hero-section-->
    <div class="home">
        <h2>Scopri le nostre Monster</h2>
        <div class="img-filter">
        </div>
    </div>
    <!--end-hero-section-->

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




    <!--products-section-->
    <section class="prodotti">
        <h2>Le nostre Lattine</h2>
        <section class="sezione-filtri">
        <form action="<?php ($_SERVER['PHP_SELF']) ?>" method="post"  class="form1">
            <select name="Categoria" id="Categoria" class='scelta-filtro'>
                <?PHP
                    $ris = $con->query($queryCategoria) or die("Query Fallita!");
                    echo "<option value=''>Tutte le categorie</option>";
                    foreach($ris as $riga){
                        echo $riga['Nome']."<br>";
                        
                        echo "<option value=".$riga['Nome'].">".$riga['Nome']."</option>";
                    }
                    

                    $con->close();
                ?>
			</select>
            <select id="Prezzo" name="Prezzo" class="scelta-filtro">
                <option value="ordine-standard">Ordine Standard</option>
                <option value="prezzo-crescente">Ordine Crescente</option>
                <option value="prezzo-decrescente">Ordine Decrescente</option>
            </select>

        </div>
        <button class="button-filtri" type="submit"><i class="fa-solid fa-sliders fa-lg"></i></button>
    </form>
    </section>
        <div class="prodotti-lista">
            <div class="prodotti-lista-1">
            <div class="prodotti-lista-1">
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
        $ris = $con->query($query) or die("Query Fallita!");
        $con->close();
        $row_cnt = $ris->num_rows;

        //echo "Ho ottenuto ".$row_cnt." occorrenze"; 

        
    foreach ($ris as $riga) {
        echo "<div class='card-prodotti'>";
        $encoded_image = base64_encode($riga["foto"]);
        $image_url = 'data:image/png;base64,' . $encoded_image;
        echo "<div class='card-prodotti-left' style='background-image: url(" . $image_url . ");'></div>";
        echo "<div class='card-prodotti-right'>";
        echo "<h3>" . $riga["Nome"] . "</h3>";
        echo "<p>" . $riga["Descrizione_Generale"] . "</p>";
        echo "<a href='monster.php?ID_Monster=".$riga["ID_Monster"]."'><button>Scopri di più</button></a>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

                <!--<div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>
                <div class="card-prodotti">
                    <div class="card-prodotti-left">

                    </div>
                    <div class="card-prodotti-right">
                        <h3>Nome Monster</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint consequatur nostrum autem fuga, laborum rerum pariatur non tempora.</p>
                        <a href="monster.php"><button>Scopri di più</button></a>
                    </div>
                </div>-->
    </section>
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