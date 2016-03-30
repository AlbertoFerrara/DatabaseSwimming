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
if (basename($_SERVER['HTTP_REFERER'])!='VisAttivita.php?')

{$CodAttivita=$_POST['CodAttivita'];
$Giorno = $_POST['Giorno'];
$Tipo = $_POST['Tipo'];
$Etaminima = $_POST['Etaminima'];
$CodPiscina = $_POST['CodPiscina'];
$CodiceID = $_POST['CodiceID'];

$query=mysql_query("UPDATE Attivita SET Giorno='$Giorno',Tipo='$Tipo', Etaminima='$Etaminima',CodPiscina='$CodPiscina',CodiceID='$CodiceID'
 WHERE CodAttivita=$CodAttivita"); 


if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table><tr>
<form action="VisAttivita.php" align="left">
       <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form>
<?php
}
?>
 
