<h3>INSERIMENTO ATTIVITA' SVOLTA DA CLIENTE</h3>
<?php 
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
?>
<form action="InsSvolgono2.php" method="POST">
<table><tr><td>
Seleziona Cliente: 
<select name="Svolgono">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Clienti"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodCliente] $cicle[Nome] $cicle[Cognome] </option>
END;
}
?>
</select></td>
<td>
<input type="submit" value="Avanti" /></td>
</form>
  
 <form action=Inserimento.php>
 <td> <input type=submit value=BACK /></td></tr></table>
  </form>
<?php
}
?>
