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
    
</body>
</html>