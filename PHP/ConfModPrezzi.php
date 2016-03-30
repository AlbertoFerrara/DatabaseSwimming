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
if (basename($_SERVER['HTTP_REFERER'])!='VisPrezzi.php?')
{$CodPrezzo=$_POST['CodPrezzo'];
$Giorno = $_POST['Giorno'];
$Tipo = $_POST['Tipo'];
$Prezzo = $_POST['Prezzo'];

$query=mysql_query("UPDATE PrezziEntrate SET Giorno='$Giorno',Tipo='$Tipo',Prezzo='$Prezzo'WHERE CodPrezzo=$CodPrezzo"); 

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table>
<form action="VisPrezzi.php" align="left">
       <tr><td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?> 

