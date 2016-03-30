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
<h1>INSERIMENTO SORVEGLIANZA </h1>
<form action="InserimentoGest2.php"  method="POST">
<table><tr><td> 
Seleziona Codice Bagnino
<select name="CodiceID">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT Personale.CodiceID, Personale.Nome, Personale.Cognome FROM Bagnini natural join Personale"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodiceID] $cicle[Nome] $cicle[Cognome] </option>
END;
}
?>
</select></td><td>
<input type="submit" value="AVANTI" /><td>
</form>
<form action="Inserimento.php" align="left">
 <td><input type="submit" value="BACK"/></td></tr><table>
</form>
<?
}
?>
