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
<h1>CANCELLAZIONE CLIENTE <h1>
<table><tr>
<form action="EliminaClienti.php"  method="GET">
<td>
Seleziona CodiceCliente
<select name="CodCliente">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Clienti"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodCliente']." ".$cicle['Nome']." ".$cicle['Cognome']."</option>" ;  
} 
?>
</select>
</td><td>
<input type="submit" value="ELIMINA" /> </td>
</form>
<form action="Cancellazione.php" >
<td><input type="submit" value="BACK" /></td></tr>
</form>
<?php
}
?>
 

