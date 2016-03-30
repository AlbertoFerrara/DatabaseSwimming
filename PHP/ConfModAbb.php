<?php 
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {

include("connessione_db.php"); 
if (basename($_SERVER['HTTP_REFERER'])!='VisAbbonati.php?')
{
$CodCliente=$_POST['CodAbb'];
$DataInizio = $_POST['DataInizio'];
$DataFine = $_POST['DataFine'];
$CodiceAbb =(int) $_POST['CodiceAbb'];

$query=mysql_query("UPDATE Abbonati SET DataInizio='$DataInizio', DataFine='$DataFine',CodiceAbb='$CodiceAbb' WHERE CodCliente=$CodCliente"); 


if (!$query) 
	die("Errore nella query: " . mysql_error());}

echo "Aggiornamento avvenuto "; 
?>
<br>Seleziona una delle seguenti operazioni:
<table>
<form action="VisAbbonati.php" align="left">
       <tr><td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 

<?
}
?>
