<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {

$_SESSION['Nome']=$_REQUEST['Nome'];
$_SESSION['Cognome']=$_REQUEST['Cognome'];
$_SESSION['DataNascita']=$_REQUEST['DataNascita'];
$_SESSION['LuogoNascita']=$_REQUEST['LuogoNascita'];
$_SESSION['CodiceFiscale']=$_REQUEST['CodiceFiscale'];
$_SESSION['Sesso']=$_REQUEST['Sesso'];
$Cliente=$_REQUEST['Cliente'];


if($Cliente=='Abbonato'){
	header("Location:InserimentoAbbonati.php?");}
else
   {
	   if($Cliente=='Occasionale'){
	 	header("Location:InserimentoOccasionali.php?");}

	  else
	      die("Non hai selezionato nessun tipo di cliente" . mysql_error($connessione));
   }
echo<<<END

END;
}
?>
