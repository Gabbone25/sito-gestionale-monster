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
<?PHP 
session_start();
?>
<body> 
<?php
if (isset($_GET['q'])) {
  $searchText = $_GET['q'];
  echo "hai scritto:$searchText";
}
?>
<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "aggiunta dalla collezione";
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
        <div class="monster-left">
            <div class="monster-left-img">

            </div>
        </div>
        <div class="monster-right">
            <div class="blocco-di-testo">
                <h2>Nome Monster</h2>
                <h4>Categoria</h4>
                <span>199$</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus animi, sapiente molestiae voluptatum cumque, ducimus harum doloremque vitae unde quo qui quisquam nemo rem nisi error maiores doloribus! Vel, aspernatur? 500ml</p>
                <div>
                    <form action="<?php ($_SERVER['PHP_SELF']) ?>" method="post">
                        <button class="bottone-1">Aggiungi alla collezione</button>
                    </form>
                    <button class="bottone-2"><a href="modifica-amministratore.php"><i class="fa-solid fa-pen-to-square"></i></a></button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>