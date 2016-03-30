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
if (basename($_SERVER['HTTP_REFERER'])!='VisClienti.php?')
{$CodCliente=$_POST['CodCliente'];
$Nome = $_POST['nome'];
$Cognome = $_POST['cognome'];
$DataNascita = $_POST['dataNascita'];
$LuogoNascita = $_POST['luogoNascita'];
$Sesso = $_POST['sesso'];
$CodiceFiscale = $_POST['codiceFiscale'];

$query=mysql_query("UPDATE Clienti SET Nome='$Nome',Cognome='$Cognome',DataNascita='$DataNascita',LuogoNascita='$LuogoNascita',Sesso='$Sesso',CodiceFiscale='$CodiceFiscale' WHERE CodCliente=$CodCliente"); 


if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo "Aggiornamento avvenuto "; 
?>
<br>Seleziona una delle seguenti operazioni:
<table><tr>
<form action="VisClienti.php" align="left">
      <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?>

