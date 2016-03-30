<h1>AGGIORNAMENTO PISCINE </h1>
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
<form action="ModPiscine.php"  method="POST">
<table><tr><td>
Seleziona Codice Piscina
<select name="CodPiscina">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Piscine"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodPiscina']." ".$cicle['Nome']."</option>" ;  
} 
?>
</select>
</td><td>
<input type="submit" value="AVANTI" /></td>
</form>

<form action="Aggiornamento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
<?php
}
?>
