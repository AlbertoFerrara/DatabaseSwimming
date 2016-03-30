<h1>MODIFICA CLIENTE ABBONATO</h1>
<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
 
include("connessione_db.php"); 
$CodAbb=(int)$_POST['CodCliente'];
$query = mysql_query("SELECT * FROM Abbonati NATURAL JOIN TipoAbbonamento WHERE CodCliente=$CodAbb"); 
$cicle=mysql_fetch_array($query);
echo<<<END
 <form action="ConfModAbb.php"  method="POST">
  <input type="hidden" name="CodAbb" value="$CodAbb">
  DataInizio:  <input type="text" name="DataInizio" value="$cicle[DataInizio]"><br />
  DataFine:   <input type="text" name="DataFine" value="$cicle[DataFine]"><br />
  CodiceAbb: <select name="CodiceAbb">
    <option>$cicle[CodiceAbb] $cicle[Durata] </option>
END;
$query1 = mysql_query("SELECT * FROM TipoAbbonamento "); 
  while($cicle1=mysql_fetch_array($query1)){
   if ($cicle1['CodiceAbb']!=$cicle['CodiceAbb'])
   echo "<option>".$cicle1['CodiceAbb']." ".$cicle1['Durata']. "</option>";
   }
echo<<<END
  </select>
 <br><table><tr><td>
 <input type="submit" value="MODIFICA" /></td>
</form>
<form action="$_SERVER[HTTP_REFERER]" align="left">
      <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 
