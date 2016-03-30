<h1> Passo 2 </h1>
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
$CodCliente=$_POST['CodCliente'];
$CodiceAtt=(int)$_POST['Attivita'];
$query = mysql_query("SELECT * FROM Attivita WHERE CodAttivita Not in(Select CodAttivita From Svolgono WHERE CodCliente=$CodCliente)");
echo<<<END
<form action="ConfModSvolgono.php"  method="POST">
<input type="hidden" name="CodCliente" value="$CodCliente">
<input type="hidden" name="CodiceAtt" value="$CodiceAtt">
<table><tr><td>
Modifica attivita svolta con:
<select name="Att">
END;
while($cicle=mysql_fetch_array($query)){
echo<<<END
  <option>$cicle[CodAttivita] $cicle[Giorno] $cicle[Tipo]</option>
END;
}
echo<<<END
</select>
</td><td>
<input type="submit" value="Modifica" /></td>
</form>
<form action="AggSvolgono.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;

}
?> 
