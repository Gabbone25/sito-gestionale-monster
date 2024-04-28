<!DOCTYPE html>
<html lang="IT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CN MONSTER</title>
    <link rel="stylesheet" href="css/css-index1.css">
    <link rel="stylesheet" href="css/css-nav.css">
    <script src="javascript/nav.js"></script>
    <script src="javascript/cerca.js"></script>
    <!--prova-->
    <script src="https://kit.fontawesome.com/ed3d802cc7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<?PHP 
    session_start();
?>
<body>  
    <!--header-->
    <header>
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
                                <div id="suggestions" class="ciao"></div>
                                <SCRIPT TYPE="text/javascript">
                                    function mostra(str){
                                        if(str.length == 0){
                                            document.getElementByID("suggestions").InnerHTML = "";
                                            return;
                                        }
                                        if(window.XMLHttpRequest){
                                            ajax = new XMLHttpRequest();                    //browser Moderni
                                        }
                                        else{
                                            ajax = new ActiveXObject("Microsoft.XMLHTTP");  //browser Legacy
                                        }
                                        ajax.onreadystatechange = function(){
                                            if(ajax.readyState == 4 && ajax.status == 200){
                                                document.getElementById('suggestions').innerHTML = ajax.responseText;
                                                var stringa = ajax.responseText;
                                                var tmp = new Array();
                                                tmp = stringa.split('<BR>');
                                                conta = 0;
                                                posti = [];
                                                for(i = 0; i < tmp[i].length; i++){
                                                    post[conta] = tmp[i].split(",");
                                                    conta++; //Nota GFR: ma se ci metto i al posto di conta non funziona uguale???
                                                }
                                            }
                                        }
                                        ajax.open("GET", "elabora.php?stringa="+str, true);
                                        ajax.send();
                                    }
                                </SCRIPT>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="blocco"></div>
        <!--end-navbar-->
        <div class="home">
            <div class="home-left">
            </div>
            <div class="home-right">
                <p>WE ARE<br>THE <br> ENERGY</p>
                <a href="catalogo.php" class="a-for-buttons"><button>Scopri di più</button></a>
            </div>
            
            
            <div class="extra"></div>
        </div>
    </header>
    <!--end-header-->
    <!--Monster-->
   <div class="monster-text">
        <span>Scopri il mondo Monster</span>
    </div>
    <div class="monster-section">
        <div class="card1 fade-in">
            <a href="catalogo.php">
                <div class="up1">
                    <span class="text-card">Ultra</span>
                </div>
            </a>
        </div>
        <div class="card1 fade-in">
            <a href="catalogo.php">
                <div class="up2">
                    <span class="text-card">Rehab</span>
                </div>
            </a>
        </div>
        <div class="card1 fade-in">
            <a href="catalogo.php">
                <div class="up3">
                    <span class="text-card">Caffè</span>
                </div>
            </a>
        </div>
    </div>  
    <!--ENd-Monster-->
    <!--Registrati-->
    <div class="registrati">
        <span>Unisciti al mondo delle Monster</span>
        <a href="account.php" class="a-for-buttons"><button>Registrati</button></a>
    </div>
    <!--End-Registrati-->
    <!--Collezione-->
    <div class="collezione-home">
        <div class="collezione-home-left">
            <img src="img/monster-amministratore-2.jpeg" alt="lattina-home">
        </div>
        <div class="collezione-home-right">
            <div class="title">Colleziona tutte le Monster</div>
            <span class="text-normal">Aggiungi le lattine in tuo possesso nella sezione "La mia collezione", in modo tale da poter tenere traccia delle lattine in possesso. Inoltre potrai autovalutarti tutte le lattine in tuo possesso!</span>
            <a href="collezione.php" class="a-for-buttons"><button>Collezione</button></a>
        </div>
    </div>
    <!--End-Collezione-->
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