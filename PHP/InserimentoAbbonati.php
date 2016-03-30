<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
$Nome = $_SESSION['Nome']; 
$Cognome = $_SESSION['Cognome'];
$DataNascita=$_SESSION['DataNascita'];
$LuogoNascita=$_SESSION['LuogoNascita'];
$CodiceFiscale=$_SESSION['CodiceFiscale'];
$Sesso=$_SESSION['Sesso'];
?>

<HTML>
<BODY>
<b>INSERIMENTO ABBONATO</b2>
<form action="RecuperoInsAbbonati.php"  method="POST">

  DataInizio:  <input type="date" name="DataInizio"/><br />
  DataFine: <input type="date" name="DataFine"/><br />
  Tipo Abbonamento: <select name="CodiceAbb">
 <?php  
  include("connessione_db.php");
  $query = mysql_query("SELECT * FROM TipoAbbonamento");
  while($cicle=mysql_fetch_array($query)){
  echo<<<END
  <option>$cicle[CodiceAbb] $cicle[Durata]</option>   
END;
}
echo<<<END
</select>

<input type="hidden" name="Nome" value="$Nome">
<input type="hidden" name="Cognome" value="$Cognome">
<input type="hidden" name="DataNascita" value="$DataNascita">
<input type="hidden" name="LuogoNascita" value="$LuogoNascita">
<input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
<input type="hidden" name="Sesso" value="$Sesso">
END;

?> 
</select>
<table><tr><td>
<input type="submit" value="Avanti"/>
</td>
</form>

 <form action=InserimentoClienti.php >
<td>    <input type=submit value=BACK /></td></tr></table>
</form>
</BODY>
</HTML>
<?php
}
?>
