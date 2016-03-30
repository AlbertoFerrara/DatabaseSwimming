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
<h1>AGGIORNAMENTO CLIENTE OCCASIONALE </h1>
<form action="ModOcc.php"  method="POST">
<table><tr><td>
Seleziona CodiceCliente occasionale da modificare
<select name="CodOcc">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT Occasionali.CodOccasionale,Clienti.Nome,Clienti.Cognome,Occasionali.Data_ora_entrata FROM Occasionali natural join Clienti"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodOccasionale] $cicle[Nome] $cicle[Cognome] $cicle[Data_ora_entrata] </option>
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
<?
}
?>
