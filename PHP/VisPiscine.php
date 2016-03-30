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
<h1 align="center"> PISCINE</h1>
<table align="center" width="90%" CELLSPACING="30"> 
<tr>
<td>CodPiscina</td>
<td>Nome</td>
<td>Lunghezza</td>
<td>Larghezza</td>
<td>Profondita</td>
<td>Riscaldata</td>
<td>Allocazione</td>
<td>PeriodoApertura</td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Piscine"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodPiscina']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Lunghezza']."</td><td>".$cicle['Larghezza']."</td><td>".$cicle['Profondita']."</td><td>".$cicle['Riscaldata']."</td><td>".$cicle['Allocazione']."</td><td>".$cicle['PeriodoApertura']."</td></tr>" ;  
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
