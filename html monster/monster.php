<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css-monster.css">
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
    <script src="javascript/bottone.js"></script>
    <script src="javascript/nav.js"></script>
    <link rel="stylesheet" href="css/css-nav.css">
    <title>Monster</title>
</head>
<body>
	<?php
        session_start();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "rimossa dalla collezione";
        }
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

	<section class="monster">
	    <?PHP
			// Connessione al database
			$query = "SELECT M.ID_Monster, M.Nome, M.Colore, M.Prezzo, M.Quantita_Liquido, M.Descrizione_Generale, M.Categoria_ID_categoria, M.foto, C.Nome as Categoria ";
			$query .= "FROM Monster as M ";
			$query .= "JOIN Categoria as C ON C.ID_categoria = M.Categoria_ID_categoria ";
			$query .= "WHERE M.ID_Monster = ".$_GET['ID_Monster'].";";
			$con = new mysqli("localhost", "root", "", "Monster");
			if ($con->connect_error) {
				die("Connessione fallita: " . $con->connect_error);
			}
			$ris = $con->query($query) or die("Query Fallita!");
			$con->close();
            foreach($ris as $riga){
                $encoded_image = base64_encode($riga["foto"]);
                $image_url = 'data:image/png;base64,' . $encoded_image;
            } 
		?>
		
        <div class="monster-left">
            <?php
                echo '<div class="monster-left-img" style="background-image:url(\'' . $image_url . '\');">';
                echo '</div>';
            ?>

        </div>

		
		<div class="monster-right">
            <div class="blocco-di-testo">
                <?PHP
					foreach($ris as $riga){
						echo "<h2>".$riga['Nome']."</h2>";
						echo "<h4>".$riga['Categoria']."</h4>";
						echo "<span>".$riga['Prezzo']."€</span>";
						echo "<p>".$riga['Descrizione_Generale']."</p>";
					}
				?>
				<div>
                        <?PHP

							if(isset($_SESSION['nome_utente'])){
								
								$query = "SELECT L.Utente_Registrato_ID_Utente, L.Monster_ID_Monster ";
								$query .= "FROM Lattina as L ";
								$query .= "JOIN Utente_Registrato as R ON L.Utente_Registrato_ID_Utente = R.ID_Utente ";
								$query .= "WHERE L.Monster_ID_Monster = ".$_GET['ID_Monster']." ";
								$query .= "AND R.Nome_Utente = '".$_SESSION['nome_utente']."';";
								$con = new mysqli("localhost", "root", "", "Monster");
								if ($con->connect_error) {
									die("Connessione fallita: " . $con->connect_error);
								}
								$ris = $con->query($query) or die("Query Fallita!");
								$con->close();						
								if($ris->num_rows == 0){
									echo "<A href='autovalutazione.php?ID_Monster=".$_GET['ID_Monster']."'><button class='bottone-1'>Aggiungi</button></A>";
									//echo "<A href='AggiungiLattinaACollezione.php?ID_Monster=".$_GET['ID_Monster']."&piena=0'><button class='bottone-1'>Aggiungi Vuota</button></A>";
								}
								else
									echo "<A href='RimuoviLattinaDaCollezione.php?ID_Monster=".$_GET['ID_Monster']."'><button class='bottone-1'>Rimuovi dalla collezione</button></A>";
        

                                //echo '<button class="bottone-2"><a href="autovalutazione.php"><i class="fa-solid fa-money-check-dollar"></i></a></button>';
							}
						
						?>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>