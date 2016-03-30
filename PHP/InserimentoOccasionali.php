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
$Nome = $_SESSION['Nome']; 
$Cognome = $_SESSION['Cognome'];
$DataNascita=$_SESSION['DataNascita'];
$LuogoNascita=$_SESSION['LuogoNascita'];
$CodiceFiscale=$_SESSION['CodiceFiscale'];
$Sesso=$_SESSION['Sesso'];

?>

<b>INSERIMENTO CLIENTI OCCASIONALI </b2>


<form action="InsSvolgono2.php"  method="POST">
<?php
   
$dataora=date("Y-m-j H:i:s", time());
   echo<<<END
  Data_ora_entrata: <input type="datetime" name="Data_ora_entrata" value="$dataora"  \><br /> 
  
  Prezzo: <select name="Prezzo" />

END;
   
      $query1= mysql_query("SELECT * FROM PrezziEntrate"); 
      while($cicle=mysql_fetch_array($query1)){    
        echo "<option>".$cicle['CodPrezzo']." ".$cicle['Giorno']." ".$cicle['Tipo']."</option>";
      }
      ?>
</select>

<br />
Sesso:

<select name="Sesso">
    <option>M</option>
    <option>F</option>
</select> 
<table>
<tr><td><input type="submit" value="AVANTI"/></td>
<?php 
 echo<<<END
 <input type="hidden" name="Nome" value="$Nome">
 <input type="hidden" name="Cognome" value="$Cognome">
 <input type="hidden" name="DataNascita" value="$DataNascita">
 <input type="hidden" name="LuogoNascita" value="$LuogoNascita">
 <input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
 <input type="hidden" name="Sesso" value="$Sesso">
END;
?>
</form>
<form action="InserimentoClienti.php" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>

<?php
}
?>
