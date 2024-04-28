<HTMl>
	<HEAD></HEAD>
	<BODY>
	
	<?PHP
	
		session_start();
		echo "Vuoi aggiungere la lattina ".$_GET['ID_Monster']."<br>";

		$query = "INSERT INTO Lattina (Monster_ID_Monster, Utente_Registrato_ID_Utente, isPiena, Stato_ID_Stato) "; 
		$query .= "VALUES (".$_GET['ID_Monster'].", ".$_SESSION['ID_Utente'].", ".$_GET['piena'].", 1);";
		
		$con = new mysqli("localhost", "root", "", "Monster");
		if ($con->connect_error) {
			die("Connessione fallita: " . $con->connect_error);
		}
		
		echo $query."<br>";
		
		$ris = $con->query($query) or die("Query Fallita!");
		$con->close();		
	
	?>
	
	<A href="collezione.php">Torna alla collezione</A>	
	
	</BODY>
</HTML>