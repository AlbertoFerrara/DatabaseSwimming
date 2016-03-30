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
if (basename($_SERVER['HTTP_REFERER'])!='VisPersonale.php?')
{ 
$CodiceID=$_POST['CodiceID'];
$Nome = $_POST['nome'];
$Cognome = $_POST['cognome'];
$DataNascita = $_POST['dataNascita'];
$LuogoNascita = $_POST['luogoNascita'];
$Sesso = $_POST['sesso'];
$CodiceFiscale = $_POST['CodiceFiscale'];
$RecTelefonico = $_POST['RecTelefonico'];
$Retribuzione = $_POST['Retribuzione'];

$query=mysql_query("UPDATE Personale SET Nome='$Nome',Cognome='$Cognome',DataNascita='$DataNascita',LuogoNascita='$LuogoNascita',Sesso='$Sesso',CodiceFiscale='$CodiceFiscale',RecTelefonico='$RecTelefonico',
Retribuzione='$Retribuzione' WHERE CodiceID=$CodiceID"); 


if (!$query) 
	die("Errore nella query: " . mysql_error());
}
echo "Aggiornamento avvenuto "; 
?>
<br>Scegli una delle seguenti operazioni:
<table>
<form action="VisPersonale.php" align="left">
      <tr><td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="HOME"/></td></tr></table>
</form> 
<?php
}
?>

