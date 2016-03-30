<h1>MODIFICA GESTIONE SORVEGLIANZA</h1>
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
$query = mysql_query("SELECT GestioneSorveglianza.CodPiscina, Piscine.Nome FROM GestioneSorveglianza natural join Piscine WHERE CodiceID=$CodiceID");
echo<<<END
<form action="ModGestione2.php"  method="POST">
<input type="hidden" name="CodiceID" value="$CodiceID">
<table><tr><td>
Seleziona Codice bagnino da modificare: <select name="Cod">
END;
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodPiscina] $cicle[Nome]</option>
END;
}
echo<<<END
</select></td>
<td><input type="submit" value="AVANTI" /><td>
</form>
<form action="AggGest.php" align="left">
      <td><input type="submit" value="BACK"/></td></tr><table>
</form>
END;
}
?> 

