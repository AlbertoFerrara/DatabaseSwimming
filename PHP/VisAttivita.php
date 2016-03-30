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

<h1 align="center"> ATTIVITA'</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodAttivita</td>
<td>Giorno</td>
<td>Tipo</td>
<td>Etaminima</td>
<td>CodPiscina</td>
<td>NomePiscina</td>
<td>CodiceID</td>
<td>NomeIstruttore</td>
<td>CognomeIstruttore</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT Attivita.CodAttivita,Attivita.Giorno,Attivita.Tipo,Attivita.Etaminima,Attivita.CodiceID,Personale.Nome,Personale.Cognome,Piscine.CodPiscina,Piscine.Nome as NomePis FROM Attivita Natural join Piscine join Personale on Personale.CodiceID=Attivita.CodiceID Order by Attivita.CodAttivita") ;
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodAttivita']."</td><td>".$cicle['Giorno']."</td><td>".$cicle['Tipo']."</td><td>".$cicle['Etaminima']."</td><td>".$cicle['CodPiscina']."</td><td>".$cicle['NomePis']."</td><td>".$cicle['CodiceID']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td></tr>" ;  
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
