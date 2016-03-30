<h1>MODIFICA PISCINE</h1>
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
$CodPiscina=(int)$_POST['CodPiscina'];
$query = mysql_query("SELECT * FROM Piscine WHERE CodPiscina=$CodPiscina"); 
$cicle=mysql_fetch_array($query);
if ($cicle['Riscaldata']=='No')
  $altroval='Si';
else
  $altroval='No';
if ($cicle['Allocazione']=='Interna')
  $altrall='Esterna';
else
  $altrall='Interna';
if ($cicle['PeriodoApertura']=='Annuale')
  $altroPeriodo='Estivo';
else
  $altroPeriodo='Annuale';

echo<<<END
<form action="ConfModPiscina.php"  method="POST">
  <input type="hidden" name="CodPiscina" value="$CodPiscina">
  Nome:  <input type="text" name="Nome" value="$cicle[Nome]"><br />
  Lunghezza: <input type="text" name="Lunghezza" value="$cicle[Lunghezza]"><br />
  Larghezza: <input type="text" name="Larghezza" value="$cicle[Larghezza]"><br />
  Profondita: <input type="text" name="Profondita" value="$cicle[Profondita]"><br />
  Riscaldata: <select name="Riscaldata">
    <option>$cicle[Riscaldata]</option>
    <option>$altroval</option>
   </select><br />
  Allocazione: <select name="Allocazione">
    <option>$cicle[Allocazione]</option>
    <option>$altrall</option>
   </select><br />
  PeriodoApertura: <select name="PeriodoApertura">
    <option>$cicle[PeriodoApertura]</option>
    <option> $altroPeriodo</option>
   </select><br />
   <table><tr><td><input type="submit" value="MODIFICA" /></td>
</form>
<form action="$_SERVER[HTTP_REFERER]" align="left">
      <td><input type="submit" value="BACK"/></td></tr></table>
</form>
END;
}
?> 
