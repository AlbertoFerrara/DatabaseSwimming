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
<h1>CANCELLAZIONE ATTIVITA </h1>
<table><tr>
<form action="EliminaAtt.php"  method="GET">
<td>
Seleziona CodiceAttivita
<select name="CodAttivita">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Attivita"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodAttivita']." ".$cicle['Giorno']." ".$cicle['Tipo']."</option>" ;  
} 
?>
</select>
</td><td>
<input type="submit" value="ELIMINA" /> </td>
</form>
<form action="Cancellazione.php" >
<td><input type="submit" value="BACK" /></td></tr>
</form>


<?
}
?>
 
