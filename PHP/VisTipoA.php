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
<h1 align="center"> TipoAbbonamento</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodiceAbb </td>
<td>Prezzo</td>
<td>Durata</td> 
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM TipoAbbonamento"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodiceAbb']."</td><td>".$cicle['Prezzo']."</td><td>".$cicle['Durata']."</td></tr>" ;  
} 
?> 
</table>
<?php
  echo<<<END
<form action="$_SERVER[HTTP_REFERER]" align="center">
<input type="submit" value="Back"/>
</form>
END;
}
?>
