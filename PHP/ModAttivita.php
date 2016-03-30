<h1>MODIFICA ATTIVITA'</h1>
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
$CodAttivita=(int)$_POST['CodAttivita'];
$query = mysql_query("SELECT * FROM Attivita WHERE CodAttivita=$CodAttivita"); 
$Giorni=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
$cicle=mysql_fetch_array($query);
echo<<<END
<form action="ConfModAttivita.php"  method="POST">
  <input type="hidden" name="CodAttivita" value="$CodAttivita">
  Giorno:  <select name="Giorno"> 
  <option>$cicle[Giorno]</option>
END;
  for ( $i = 0; $i <7; ++$i)  
   {if   ($Giorni[$i]!=$cicle['Giorno'])
   echo "<option>".$Giorni[$i]."</option>";"<br />";  
   }  
  
echo<<<END
  </select>
  </br>
  Tipo: <select name="Tipo">
  <option>$cicle[Tipo]</option>
END;
 $Tipo =array('Aquagym','Aquatherapy','Aquabuilding','Nuoto'); 
  for ( $i = 0; $i <4; ++$i)  
   {if   ($Tipo[$i]!=$cicle['Tipo'])
   echo "<option>".$Tipo[$i]."</option>";"<br />";  
   }  
 echo<<<END
</select>
</br>
Etaminima: <input type="text" name="Etaminima" value="$cicle[Etaminima]"><br />
Codice Piscina: <select name="CodPiscina">
<option>$cicle[CodPiscina]</option>
END;
 $query2 = mysql_query("SELECT * FROM Piscine WHERE CodPiscina!=$cicle[CodPiscina] ");
 while($cicle2=mysql_fetch_array($query2)){
echo"<option>".$cicle2[CodPiscina]."</option>";
 }
echo<<<END
</select>
</br>
Codice Istruttore: <select name="CodiceID">
<option>$cicle[CodiceID]</option><br />
END;
$query3 = mysql_query("SELECT * FROM Istruttori WHERE CodiceID!=$cicle[CodiceID] ");
 while($cicle3=mysql_fetch_array($query3)){
echo"<option>".$cicle3[CodiceID]."</option>";
 }
echo<<<END
</select>
</br><table><tr><td>
<input type="submit" value="MODIFICA" /></td>
</form>
<form action="$_SERVER[HTTP_REFERER]" align="left">
       <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 
