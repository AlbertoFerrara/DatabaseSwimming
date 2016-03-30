<h1>AGGIORNAMENTO ABBONAMENTI </h1>
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
<form action="ModAbbonamenti.php"  method="POST">
<table><tr><td>
Seleziona Codice Abbonamento
<select name="CodAbb">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM TipoAbbonamento"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodiceAbb] $cicle[Durata] </option>
END;
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
