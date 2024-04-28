<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/css-amministratore1.css">
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
     <script src="javascript/nav.js"></script>
    <link rel="stylesheet" href="css/css-nav.css">
    <title>Document</title>
</head>
<?PHP 
session_start();
?>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $foto = $_POST['foto'];
            $nome = $_POST['nome'];
            $categoria = $_POST['categoria'];
            $descrizione = $_POST['longText'];
            $capacità = $_POST['capacità'];
            $prezzo = $_POST['prezzo'];

            echo "foto: $foto <br>";
            echo "Nome: $nome <br>";
            echo "categoria: $categoria <br>";
            echo "Descrizione: $descrizione <br>";
            echo "capacità: $capacità <br>";
            echo "prezzo: $prezzo <br>";
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
    <!--Sezione-Amministratore-text-->
    <section class="text-amministratore">
        <h2>Sezione amministratore</h2>
    </section>
    <!--end-Sezione-Amministratore-text-->
    <!--Sezione-Aggiungi-Monster-->
    <section class="aggiungi-monster">
        <div class="testo-aggiungi">
            <h2>Aggiungi Monster al catalogo</h2>
        </div>
        <div class="form-aggiungi">
            <form action="<?php ($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="blocco-immagine">
                    <div id="imageRectangle" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <input type="file"  name="foto" id="fileInput" accept="image/*" onchange="handleFileSelect(event)">
                        <div id="imageContainer"><label for="fileInput">+</label></div>
                    </div>
                </div>
                <div class="input-blocco">
                    <div class="nome-categoria">
                        <input type="text" name="nome" placeholder="Nome Monster">
                        <input type="text" name="categoria" placeholder="Categoria">
                    </div>
                    <div class="descrizione">
                        <textarea id="longText" name="longText" placeholder="Inserisci il tuo testo qui..."></textarea>
                    </div>
                    <div class="prezzo-capacità">
                        <input type="number" name="capacità" placeholder="capacità(ml)">
                        <input type="number" name="prezzo" placeholder="Prezzo">
                    </div>
                    <div class="bottoni">
                        <button class="aggiungi">Aggiungi</button>
                        <div class="home"><a href="sezione-amministratore.html"><i class="fa-solid fa-house"></i></a></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--end-Sezione-Aggiungi-Monster-->
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
    <script>
        function allowDrop(event) {
            event.preventDefault();
        }

        function drop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            handleFiles(files);
        }

        function handleFileSelect(event) {
            const files = event.target.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            const imageRectangle = document.getElementById("imageRectangle");
            const imageContainer = document.getElementById("imageContainer");
            const label = imageRectangle.querySelector("label");

            if (files.length > 0) {
                const file = files[0];

                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const img = new Image();
                        img.src = e.target.result;
                        img.alt = "Dropped image";
                        imageContainer.innerHTML = "";
                        imageContainer.appendChild(img);
                        label.style.display = "none";
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert("Il file selezionato non è un'immagine.");
                }
            }
        }
    </script>
</body>
</html>