<?php
    $q = $_GET["stringa"];
    $lattina = ""; // Inizializzazione della variabile $lattina
    if(strlen($q) > 0){
        //dati per il db
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "Monster";
        // Connessione al database
        $con = new mysqli($servername, $username, $password, $dbname);
        if(mysqli_connect_errno()){
            printf("Connessione non effettuata %i\n", mysqli_connect_error());
            exit();
        }

        $query = "SELECT M.Nome FROM Monster as M ";
        $query .= "JOIN Categoria as C ON C.ID_categoria = M.Categoria_ID_categoria "; 
        $query .= "WHERE M.Nome LIKE '".$q."%' ORDER BY M.Nome";
        var_dump($query);
            if($res->num_rows > 0){
                foreach($ris as $riga){
                    $lattina = $riga['Nome'];
            }
        $con->close(); // Chiusura della connessione al database
    }
    if(strlen($lattina) == 0){
        echo "nessun nome trovato";
    } else{
        echo $lattina;
    }
}
?>

