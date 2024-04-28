<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se sono stati inviati i dati del modulo
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nome_utente = $_POST['nome_utente'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Esegui le operazioni necessarie con i dati del modulo

    // Ad esempio, stampa i dati per il controllo
    echo "Nome: $nome <br>";
    echo "Cognome: $cognome <br>";
    echo "Nome utente: $nome_utente <br>";
    echo "Email: $email <br>";
    // NOTA: NON STAMPARE LA PASSWORD IN CHIARO, MA SOLO PER SCOPI DI DEMONSTRAZIONE
    echo "Password: $password <br>";
}
?>
