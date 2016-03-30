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
if (basename($_SERVER['HTTP_REFERER'])!='VisBadge.php?')
{$CodBadge=$_POST['CodBadge'];
$Datascadenza = $_POST['Datascadenza'];

$query=mysql_query("UPDATE Badge SET Datascadenza='$Datascadenza' WHERE CodiceTessera=$CodBadge"); 

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Seleziona una delle seguenti operazioni:
<table><tr>
<form action="VisBadge.php" align="left">
       <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?>

