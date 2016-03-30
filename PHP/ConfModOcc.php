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
if (basename($_SERVER['HTTP_REFERER'])!='VisOccasionali.php?')
{$CodOcc=(int)$_POST['CodOcc'];
$Data_ora_entrata = $_POST['Data_ora_entrata'];
$Prezzo = (int)$_POST['Prezzo'];


$query0=mysql_query("SET FOREIGN_KEY_CHECKS=0");
$query=mysql_query("UPDATE Occasionali SET Data_ora_entrata='$Data_ora_entrata',Prezzo=$Prezzo WHERE CodOccasionale=$CodOcc"); 
$query0=mysql_query("SET FOREIGN_KEY_CHECKS=1");

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table><tr> 
<form action="VisOccasionali.php" align="left">
       <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form>
<?php
}
?>

