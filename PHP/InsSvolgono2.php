<h3>INSERIMENTO ATTIVITA' SVOLTA DA CLIENTE</h3>
<?php 
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
?>
<form action="RecuperoInsSvolgono.php" method="POST">


<?php 
$ref = basename($_SERVER['HTTP_REFERER']);

include("connessione_db.php"); 
if ($ref=='InserimentoOccasionali.php?')
{$Nome = $_POST['Nome']; 
$Cognome = $_POST['Cognome'];
$DataNascita=$_POST['DataNascita'];
$LuogoNascita=$_POST['LuogoNascita'];
$CodiceFiscale=$_POST['CodiceFiscale'];
$Sesso=$_POST['Sesso'];
$Data_ora_entrata=$_POST['Data_ora_entrata'];
$Prezzo=$_POST['Prezzo'];
echo<<<END
<input type="hidden" name="Nome" value="$Nome">
<input type="hidden" name="Cognome" value="$Cognome">
<input type="hidden" name="DataNascita" value="$DataNascita">
<input type="hidden" name="LuogoNascita" value="$LuogoNascita">
<input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
<input type="hidden" name="Sesso" value="$Sesso">
<input type="hidden" name="Data_ora_entrata" value="$Data_ora_entrata">
<input type="hidden" name="Prezzo" value="$Prezzo">
<input type="hidden" name="link" value="$ref">
END;
?>
Seleziona attivita' :<select name="AttSvolta">
<?php
$query = mysql_query("SELECT * FROM Attivita") ; 
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodAttivita] $cicle[Giorno] $cicle[Tipo] </option>
END;
}
?>
</select>

<?php
}
if ($ref=='InserimentoOcc.php' or $ref=='InserimentoSvolgono.php' or $ref=='InserimentoOcc.php?' or $ref=='InserimentoSvolgono.php?')
{
 $CodCliente=(int)$_POST['Svolgono'];
 $query = mysql_query("SELECT * FROM Attivita WHERE CodAttivita Not in(Select CodAttivita From Svolgono where CodCliente=$CodCliente)"); 
 echo "Seleziona Attivita: <select name=AttSvolta>";
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodAttivita] $cicle[Giorno] $cicle[Tipo] </option>
END;
}
echo<<<END
</select>
<input type="hidden" name="link" value="$ref">
<input type="hidden" name="Svolgono" value="$CodCliente">
END;
}
if ($ref=='InserimentoOcc.php' or $ref=='InserimentoOcc.php?')
{$Data_ora_entrata=$_POST['Data_ora_entrata'];
$Prezzo=$_POST['Prezzo'];
echo<<<END
 <input type="hidden" name="Data_ora_entrata" value="$Data_ora_entrata">
 <input type="hidden" name="Prezzo" value="$Prezzo">
END;
} 
echo<<<END
<table><tr>
<td><input type="submit" value="AVANTI" /></td>
</form>
<form action="$_SERVER[HTTP_REFERER]" align="left">
      <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?>
