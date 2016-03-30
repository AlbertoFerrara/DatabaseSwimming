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
<h1 align="center"> GESTIONE SORVEGLIANZA </h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodiceID</td>
<td>Nome</td>
<td>Cognome</td>
<td>CodPiscina</td>
<td>NomePiscina</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT GestioneSorveglianza.CodiceID,Personale.Nome,Personale.Cognome,Piscine.CodPiscina,Piscine.Nome as NomePis FROM GestioneSorveglianza natural join Personale join Piscine on GestioneSorveglianza.CodPiscina=Piscine.CodPiscina Order by CodiceID "); 
while($cicle=mysql_fetch_array($query)){ 
echo<<<END
<tr><td>$cicle[CodiceID]</td><td> $cicle[Nome]</td><td>$cicle[Cognome]</td><td>$cicle[CodPiscina]</td><td>$cicle[NomePis]</td></tr>
END;
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
