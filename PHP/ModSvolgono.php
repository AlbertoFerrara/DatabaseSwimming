<h1>MODIFICA ATTIVITA' SVOLTA</h1>
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
$query = mysql_query("SELECT Svolgono.CodAttivita, Attivita.Giorno, Attivita.Tipo FROM Svolgono natural join Attivita WHERE Svolgono.CodCliente=$CodCliente");
echo<<<END
<form action="ModSvolgono2.php"  method="POST">
<input type="hidden" name="CodCliente" value="$CodCliente">
<table><tr><td>
Seleziona attivita svolta da modificare: 
<select name="Attivita">
END;
while($cicle=mysql_fetch_array($query)){
echo<<<END
  <option>$cicle[CodAttivita] $cicle[Giorno] $cicle[Tipo]</option>
END;
}
echo<<<END
</select>
</td>
<td><input type="submit" value="Avanti" /></td>
</form>
<form action="AggSvolgono.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 
