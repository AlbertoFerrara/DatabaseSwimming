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

<b>INSERIMENTO PERSONALE </b2>


<form action="RecuperoInsPersonale.php"  method="POST">

  Nome:  <input type="text" name="Nome"/><br />
  Cognome: <input type="text" name="Cognome"/><br />
  DataNascita: <input type="date" name="DataNascita"/><br />
  LuogoNascita: <input type="text" name="LuogoNascita"/><br />
  Indirizzo: <input type="text" name="Indirizzo"/><br />
  CodiceFiscale: <input type="text" name="CodiceFiscale"/><br />
  RecTelefonico: <input type="tel" name="RecTelefonico"/><br />
  Retribuzione: <input type="float" name="Retribuzione"/><br />
  Brevettorilasciatoil:  <input type="date" name="Brevettorilasciatoil"/><br />
  ScadenzaBrevetto: <input type="date" name="ScadenzaBrevetto"/><br />
  NumeroBrevetto: <input type="text" name="NumeroBrevetto"/><br />
  
Sesso:

<select name="Sesso">
    <option>---</option>
    <option>M</option>
    <option>F</option>
</select>

Ruolo: 

<select name="Ruolo">
    <option>---</option>
    <option>Istruttore</option>
    <option>Bagnino</option>
</select>
<table>
<tr><td> 
<input type="submit" value="Avanti" /></td>

</form>
<form action="Inserimento.php"  method="POST">
<td><input type="submit" value="Back" /></td>
</tr></table>
</form>

<?
}
?>
