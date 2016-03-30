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
<h1 align="center"> PrezziEntrate</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodPrezzo</td>
<td> Giorno</td>
<td> Tipo </td> 
<td> Prezzo </td> 
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM PrezziEntrate"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodPrezzo']."</td><td>".$cicle['Giorno']."</td><td>".$cicle['Tipo']."</td><td>".$cicle['Prezzo']." Euro</td></tr>" ;  
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
