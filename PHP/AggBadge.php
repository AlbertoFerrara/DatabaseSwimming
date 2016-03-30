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

<h1>AGGIORNAMENTO BADGE </h1>
<form action="ModBadge.php"  method="POST">
<table><tr><td> 
Seleziona Codice Badge del Abbonato da modificare
<select name="CodBadge">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT Badge.CodiceTessera,Clienti.Nome,Clienti.Cognome FROM Clienti natural join Abbonati join Badge on(Badge.CodiceTessera=Abbonati.badge)  "); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodiceTessera] $cicle[Nome] $cicle[Cognome] </option>
END;
}
?>
</select></td><td>
<input type="submit" value="AVANTI" /><td>
</form>
<form action="Aggiornamento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr><table>
</form>
<?
}
?>
