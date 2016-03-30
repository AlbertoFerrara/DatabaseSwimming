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
<h1 align="center"> SVOLGONO </h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodCliente</td>
<td>Nome</td>
<td>Cognome</td>
<td>CodAttivita</td>
<td>Giorno</td>
<td>Tipo</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Svolgono Natural join Clienti Natural join Attivita order by CodCliente "); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodCliente']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['CodAttivita']."</td><td>".$cicle['Giorno']."</td><td>".$cicle['Tipo']."</td></tr>";
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
