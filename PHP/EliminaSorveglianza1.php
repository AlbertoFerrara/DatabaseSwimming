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
<form action="EliminaSorveglianza2.php" Method="GET">
<?php
include("connessione_db.php"); 
$CodiceID=(int)$_REQUEST['CodiceID'];
$query=mysql_query("Select * FROM GestioneSorveglianza natural join Piscine WHERE CodiceID=\"$CodiceID\" ");
echo "Seleziona piscina sorvegliata:<table><tr><td><select name=CodPiscina>";

while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodPiscina']." ".$cicle['Nome']."</option>";}  
echo<<<END
</select>
</td>
<input type="hidden" name="CodiceID" value="$CodiceID" /></td>
<td><input type="submit" value="ELIMINA" /></td>
</form>
<form action="CancSorveglianza.php" >
<td><input type="submit" value="BACK" /></td></tr>
</form>  
END;


}
?>

