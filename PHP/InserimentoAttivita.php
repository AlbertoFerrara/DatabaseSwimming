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

<b>INSERIMENTO ATTIVITA </b2>


<form action="RecuperoInsAttivita.php"  method="POST">
Tipo:
<select name="Tipo">
    <option>---</option>
    <option>Aquagym</option>
    <option>Aquatherapy</option>
    <option>Aquabuilding</option>
    <option>Nuoto</option>
</select>
Giorno:
<select name="Giorno">
    <option>---</option>
    <option>Monday</option>
    <option>Tuesday</option>
    <option>Wednesday</option>
    <option>Thursday</option>
    <option>Friday</option>
    <option>Saturday</option>
    <option>Sunday</option>
</select>
<br>

  Etaminima:  <input type="text" name="Etaminima"/><br />
  CodPiscina: 
<select name="CodPiscina">
<?php
include("connessione_db.php"); 
$query = mysql_query("SELECT * FROM Piscine"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodPiscina']." ".$cicle['Nome']."</option>" ;  
} 
?>
</select>
<br>
  CodiceIstruttore: 
<select name="CodiceID">
<?php 
$query = mysql_query("SELECT Istruttori.CodiceID,Personale.Nome,Personale.Cognome FROM Personale natural join Istruttori"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodiceID] $cicle[Nome] $cicle[Cognome] </option>
END;
}
?>
</select>
<Table><tr><td>
<input type="submit" value="AVANTI" /></td>
</form>

<?php
 echo<<<END
<form action="Inserimento.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?>
