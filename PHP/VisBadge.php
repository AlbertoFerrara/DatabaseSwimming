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


<h1 align="center"> BADGE</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodiceTessera</td>
<td>NomeAbbonato</td>
<td>CognomeAbbonato</td>
<td>Datascadenza</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Badge join Abbonati on(Badge.CodiceTessera=Abbonati.Badge) natural join Clienti "); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodiceTessera']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['Datascadenza']."</td></tr>" ;  
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
