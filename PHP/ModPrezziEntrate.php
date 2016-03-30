<h1>MODIFICA PREZZI ENTRATE</h1>
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
$CodPrezzo=(int)$_POST['CodPrezzo'];
$query = mysql_query("SELECT * FROM PrezziEntrate WHERE CodPrezzo=$CodPrezzo");
while($cicle=mysql_fetch_array($query)){
if ($cicle['Giorno']=='Feriale')
   $altrogiorno='Festivo';
else
   $altrogiorno='Feriale';
echo<<<END
<form action="ConfModPrezzi.php"  method="POST">
<input type="hidden" name="CodPrezzo" value="$CodPrezzo">
Giorno: <select name="Giorno">
  <option>$cicle[Giorno]</option>
  <option>$altrogiorno</option>
</select>
  </br>
  Tipo: <select name="Tipo">
  <option>$cicle[Tipo]</option>
END;
 $Tipo=array('Giornaliero','Pomeridiano','Mattutino'); 
  for ( $i = 0; $i <3; ++$i)  
   {if   ($Tipo[$i]!=$cicle['Tipo'])
   echo "<option>".$Tipo[$i]."</option>";}
 "<br />";  
 echo<<<END
</select>
</br>
Prezzo: <input type="text" name="Prezzo" value="$cicle[Prezzo]">
<br />
<table><tr> 
<td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggPrezziEntrate.php" align="left">
       <td> <input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}}
?> 
