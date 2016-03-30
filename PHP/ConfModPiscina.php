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
if (basename($_SERVER['HTTP_REFERER'])!='VisPiscine.php?')
{$CodPiscina=$_POST['CodPiscina'];
$Nome = $_POST['Nome'];
$Lunghezza = $_POST['Lunghezza'];
$Larghezza = $_POST['Larghezza'];
$Profondita = $_POST['Profondita'];
$Riscaldata = $_POST['Riscaldata'];
$Allocazione = $_POST['Allocazione'];
$PeriodoApertura = $_POST['PeriodoApertura'];

$query=mysql_query("UPDATE Piscine SET Nome='$Nome', Lunghezza='$Lunghezza', Larghezza='$Larghezza', Profondita='$Profondita', Riscaldata='$Riscaldata', Allocazione='$Allocazione' ,PeriodoApertura='$PeriodoApertura' WHERE CodPiscina=$CodPiscina"); 


if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table>
<form action="VisPiscine.php" align="left">
      <tr><td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?>

