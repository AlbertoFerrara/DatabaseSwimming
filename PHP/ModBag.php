<h1>MODIFICA BAGNINI</h1>
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
$CodiceID=(int)$_POST['CodiceID'];
$query = mysql_query("SELECT * FROM Bagnini WHERE CodiceID=$CodiceID"); 
echo<<<END
   <form action="ConfModBagnini.php"  method="POST">
   <input type="hidden" name="CodiceID" value="$CodiceID">
END;
$cicle=mysql_fetch_array($query);
echo<<<END
 <table><tr> 
 Brevettorilasciatoil: <input type="text" name="Brevettorilasciatoil" value="$cicle[Brevettorilasciatoil]"><br />
 ScadenzaBrevetto: <input type="text" name="ScadenzaBrevetto" value="$cicle[ScadenzaBrevetto]"><br />
 NumeroBrevetto: <input type="text" name="NumeroBrevetto" value="$cicle[NumeroBrevetto]"><br />
 <td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="AggBagnini.php" align="left">
      <td> <input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 
