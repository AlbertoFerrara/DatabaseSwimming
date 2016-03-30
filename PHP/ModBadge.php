<h1>MODIFICA BADGE</h1>
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
$CodBadge=(int)$_POST['CodBadge'];
$query = mysql_query("SELECT * FROM Badge WHERE CodiceTessera=$CodBadge"); 
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <form action="ConfModBadge.php"  method="POST">
  <input type="hidden" name="CodBadge" value="$CodBadge">
  Datascadenza: <input type="text" name="Datascadenza" value="$cicle[Datascadenza]"><br />
 <table><tr><td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggBadge.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr><table>
</form>
END;
}}
?> 
