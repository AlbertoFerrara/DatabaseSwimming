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
$CodiceID=$_POST['CodiceID'];
$Cod=(int)$_POST['Cod'];
$query = mysql_query("SELECT * FROM Piscine WHERE CodPiscina Not in(Select CodPiscina From GestioneSorveglianza WHERE CodiceID=$CodiceID)");
echo<<<END
<form action="ConfModGestione.php"  method="POST">
<input type="hidden" name="CodiceID" value="$CodiceID">
<input type="hidden" name="Cod" value="$Cod">
<table><tr><td>
Modifica Piscina sorvegliata con:
<select name="Pisc">
END;
while($cicle=mysql_fetch_array($query)){
echo<<<END
  <option>$cicle[CodPiscina] $cicle[Nome]</option>
END;
}
echo<<<END
</select>
</td>
<td><input type="submit" value="Modifica" /></td>
</form>
<form action="AggGest.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr><table>
</form>
END;
}
?> 
