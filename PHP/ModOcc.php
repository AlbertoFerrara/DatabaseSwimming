<h1>MODIFICA CLIENTE OCCASIONALE</h1>
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
$CodOcc=(int)$_POST['CodOcc'];
$query = mysql_query("SELECT * FROM Occasionali join PrezziEntrate on(Occasionali.Prezzo=PrezziEntrate.CodPrezzo) WHERE Occasionali.CodOccasionale=$CodOcc"); 
$cicle=mysql_fetch_array($query);
echo<<<END
 <form action="ConfModOcc.php"  method="POST">
  <input type="hidden" name="CodOcc" value="$CodOcc">
  Data e ora di entrata:  <input type="text" name="Data_ora_entrata" value="$cicle[Data_ora_entrata]"><br />
  Prezzo: <select name="Prezzo">
    <option>$cicle[Prezzo] $cicle[Giorno] $cicle[Tipo]</option>
END;
$query1 = mysql_query("SELECT * FROM PrezziEntrate "); 
  while($cicle1=mysql_fetch_array($query1)){
   if ($cicle1['CodPrezzo']!=$cicle['Prezzo'])
   echo "<option>".$cicle1['CodPrezzo'].' '.$cicle1['Giorno'].' '.$cicle1['Tipo']."</option>";
   }
echo<<<END
  </select>
 <br>
 <table><tr>
 <td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggOccasionali.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 

