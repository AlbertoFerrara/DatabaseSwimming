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
if (basename($_SERVER['HTTP_REFERER'])!='VisIstruttori.php?')
{$CodiceID=$_POST['CodiceID'];
$Brevettorilasciatoil = $_POST['Brevettorilasciatoil'];
$ScadenzaBrevetto = $_POST['ScadenzaBrevetto'];
$NumeroBrevetto = $_POST['NumeroBrevetto'];

$query=mysql_query("UPDATE Istruttori SET Brevettorilasciatoil='$Brevettorilasciatoil',ScadenzaBrevetto='$ScadenzaBrevetto',NumeroBrevetto='$NumeroBrevetto'   WHERE CodiceID=$CodiceID"); 

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table><tr>
<form action="VisIstruttori.php" align="left">
     <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?>

