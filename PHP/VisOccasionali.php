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
<h1 align="center"> OCCASIONALI</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodOccasionale</td>
<td>CodCliente</td>
<td>Nome</td>
<td>Cognome</td>
<td>Data_ora_entrata</td>
<td> CodPrezzo</td>
<td>PrezzoPagato</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT Occasionali.CodOccasionale,Occasionali.CodCliente,Clienti.Nome,Clienti.Cognome,Occasionali.Data_ora_entrata,Occasionali.Prezzo,PrezziEntrate.Prezzo as PrezzoPagato FROM Occasionali natural join Clienti join PrezziEntrate on (Occasionali.Prezzo=PrezziEntrate.CodPrezzo) order by Occasionali.CodOccasionale "); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodOccasionale']."</td><td>".$cicle['CodCliente']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['Data_ora_entrata']."</td><td>".$cicle['Prezzo']."</td><td>".$cicle['PrezzoPagato']."</td></tr>" ;  
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
