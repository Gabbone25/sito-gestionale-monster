<HTMl>
	<HEAD></HEAD>
	<BODY>
	
	<?PHP
	
		session_start();
		echo "Vuoi rimuovere la lattina ".$_GET['ID_Monster']."<br>";

		$query = "DELETE FROM Lattina "; 
		$query .= "WHERE Monster_ID_Monster = ".$_GET['ID_Monster']." ";
		$query .= "AND Utente_Registrato_ID_Utente = ".$_SESSION['ID_Utente'].";";
		
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