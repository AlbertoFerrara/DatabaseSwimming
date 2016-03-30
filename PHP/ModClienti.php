<h1>MODIFICA CLIENTE</h1>
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
$CodCliente=(int)$_POST['CodCliente'];
$query = mysql_query("SELECT * FROM Clienti WHERE CodCliente=$CodCliente"); 
$cicle=mysql_fetch_array($query);
if ($cicle['Sesso']=='M')
$altrosesso='F';
else
$altrosesso='M';

echo<<<END
<form action="ConfModClienti.php"  method="POST">
  <input type="hidden" name="CodCliente" value="$CodCliente">
  Nome:  <input type="text" name="nome" value="$cicle[Nome]"><br />
  Cognome: <input type="text" name="cognome" value="$cicle[Cognome]"><br />
  DataNascita: <input type="text" name="dataNascita" value="$cicle[DataNascita]"><br />
  LuogoNascita: <input type="text" name="luogoNascita" value="$cicle[LuogoNascita]"><br />
  Sesso: <select name="sesso">
    <option>$cicle[Sesso]</option>
    <option>$altrosesso</option>
   </select>
 <br>
  CodiceFiscale: <input type="text" name="codiceFiscale" value="$cicle[CodiceFiscale]"><br />
  <table><td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggCliente.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 


