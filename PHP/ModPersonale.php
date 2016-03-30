<h1>MODIFICA PERSONALE</h1>
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
$CodiceID=(int)$_POST['CodiceID'];
$query = mysql_query("SELECT * FROM Personale WHERE CodiceID=$CodiceID"); $cicle=mysql_fetch_array($query);
if ($cicle['Sesso']=='M')
$altrosesso='F';
else
$altrosesso='M';

echo<<<END
<form action="ConfModPersonale.php"  method="POST">
  <input type="hidden" name="CodiceID" value="$CodiceID">
  Nome:  <input type="text" name="nome" value="$cicle[Nome]"><br />
  Cognome: <input type="text" name="cognome" value="$cicle[Cognome]"><br />
  DataNascita: <input type="text" name="dataNascita" value="$cicle[DataNascita]"><br />
  LuogoNascita: <input type="text" name="luogoNascita" value="$cicle[LuogoNascita]"><br />
  Indirizzo: <input  name="Indirizzo" value="$cicle[Indirizzo]"><br />
  Sesso: <select name="sesso">
    <option>$cicle[Sesso]</option>
    <option>$altrosesso</option>
   </select>
 <br>
   CodiceFiscale: <input type="text" name="CodiceFiscale" value="$cicle[CodiceFiscale]"><br />
  RecTelefonico: <input type="tel" name="RecTelefonico"  value=$cicle[RecTelefonico]><br />
  Retribuzione: <input type="text" name="Retribuzione"  value=$cicle[Retribuzione]><br />
  <table><tr><td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggPersonale.php" align="left">
      <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 

