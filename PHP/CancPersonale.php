<?
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
	?>
<h1>CANCELLAZIONE PERSONALE <h1>
<table><tr>
<form action="EliminaPersonale.php"  method="GET">
<td>
Seleziona CodicePersonale
<select name="CodiceID">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Personale"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodiceID']." ".$cicle['Nome']." ".$cicle['Cognome']."</option>" ;  
} 
?>
</select>
</td><td>
<input type="submit" value="ELIMINA" /></td>
</form>
<form action="Cancellazione.php" >
<td><input type="submit" value="BACK" /></td></tr>
</form>

<?
}
?>
