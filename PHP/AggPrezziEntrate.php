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
<h1>AGGIORNAMENTO PREZZI ENTRATE </h1>
<form action="ModPrezziEntrate.php"  method="POST">

<h2>Seleziona Codice Prezzo Entrata </h2>
<table><tr><td>
<select name="CodPrezzo">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM PrezziEntrate"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodPrezzo] $cicle[Giorno] $cicle[Tipo] </option>
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
