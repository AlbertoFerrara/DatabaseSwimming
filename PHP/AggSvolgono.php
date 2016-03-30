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
<h1>AGGIORNAMENTO SVOLGONO </h1>
<form action="ModSvolgono.php"  method="POST">
<table><tr><td>
Seleziona Codice Cliente di cui si vuole modificare le attivita svolte
<select name="CodCliente">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Clienti"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodCliente] $cicle[Nome] $cicle[Cognome]</option>
END;
}
?>
</select></td><td>
<input type="submit" value="AVANTI" /></td>
</form>
<form action="Aggiornamento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>

<?
}
?>
