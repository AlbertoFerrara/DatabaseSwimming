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
<h1>INSERIMENTO CLIENTE OCCASIONALE </h1>

<form action="InsSvolgono2.php"  method="POST">
Seleziona CodiceCliente
<select name="Svolgono">
<?php 
include("connessione_db.php"); 
 
$query = mysql_query("SELECT CodCliente,Nome,Cognome FROM Clienti where CodCliente Not In(Select CodCliente From Abbonati)"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodCliente] $cicle[Nome] $cicle[Cognome]</option>
END;
}
?>
</select><br>
<?php
$dataora=date("Y-m-j H:i:s", time());
echo <<< END
Data_ora_entrata: <input type="datetime" name="Data_ora_entrata" value="$dataora"/><br />
Prezzo: <select name="Prezzo"/>
END;
 
      $query= mysql_query("SELECT * FROM PrezziEntrate"); 
      while($cicle=mysql_fetch_array($query)){    
        echo "<option>".$cicle['CodPrezzo']." ".$cicle['Giorno']." ".$cicle['Tipo']."</option>";
      }
?>
</select>
<Table><tr><td>
<input type="submit" value="AVANTI" /></td>
</form>

<form action="Inserimento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
<?php
 
}
?>
