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
<h1 align="center"> BAGNINI </h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodiceID</td>
<td>Nome</td>
<td>Cognome</td>
<td>Brevettorilasciatoil</td>
<td>ScadenzaBrevetto</td>
<td>NumeroBrevetto</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Bagnini Natural join Personale"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodiceID']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['Brevettorilasciatoil']."</td><td>".$cicle['ScadenzaBrevetto']."</td><td>".$cicle['NumeroBrevetto']."</td></tr>";
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
