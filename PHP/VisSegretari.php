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
<h1 align="center"> SEGRETARI </h1>
<table align="right" width="100%" CELLSPACING="40"> 
<tr>
<td>CodiceID</td>
<td>Nome</td>
<td>Cognome</td>
<td>Ruolo</td>
<td>Password</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Segretari natural join Personale"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodiceID']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['Ruolo']."</td><td>".$cicle['Password']."</td></tr>";
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
