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

<HTML>
<BODY>
<b>INSERIMENTO CLIENTI</b2>

<form action="TipoClienteInserito.php"  method="GET">

  Nome:  <input type="text" name="Nome"/><br />
  Cognome: <input type="text" name="Cognome"/><br />
  DataNascita: <input type="date" name="DataNascita"/><br />
  LuogoNascita: <input type="text" name="LuogoNascita"/><br />
  CodiceFiscale: <input type="text" name="CodiceFiscale"/><br />
  
</select>
Sesso:

<select name="Sesso">
    <option>M</option>
    <option>F</option>
</select>
Scegli il tipo di cliente:<select name="Cliente">
    <option>------</option>
    <option>Occasionale</option>
    <option>Abbonato</option>
</select>
<table><tr><td>
<input type="submit" value="Avanti"/></td>

</form>
<form action="Inserimento.php">
<td><input type="submit" value="Back"/></td></tr></table>
</form>
</BODY>
</HTML>
<?
}
?>
