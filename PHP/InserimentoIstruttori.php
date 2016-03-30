<?
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
?>
<form action="RecuperoInsIstruttori.php"  method="POST">
<fieldset>
  Brevettorilasciatoil:  <input type="text" name="Brevettorilasciatoil"><br />
  ScadenzaBrevetto: <input type="text" name="ScadenzaBrevetto"><br />
  NumeroBrevetto: <input type="text" name="NumeroBrevetto"><br />

<input type="submit" value="Invia" />

</form>

<?
}
?>
