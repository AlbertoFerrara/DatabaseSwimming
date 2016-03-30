<h1>MODIFICA TIPI DI ABBONAMENTI</h1>
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
$CodAbb=(int)$_POST['CodAbb'];
$query = mysql_query("SELECT * FROM TipoAbbonamento WHERE CodiceAbb=$CodAbb");
while($cicle=mysql_fetch_array($query)){

echo<<<END
<form action="ConfModTipiAbbonamenti.php"  method="POST">
<input type="hidden" name="CodiceAbb" value="$CodAbb">
Prezzo: <input type="text" name="Prezzo" value="$cicle[Prezzo]"><br>

END;


echo<<<END

<br>
<table><tr><td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggAbbonamento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}}
?> 

