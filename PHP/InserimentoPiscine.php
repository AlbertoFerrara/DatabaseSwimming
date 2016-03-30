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

<b>INSERIMENTO PISCINE </b2>


<form action="RecuperoInsPiscine.php"  method="POST">

  Nome:  <input type="text" name="Nome"/><br />
  Lunghezza  (in cm): <input type="text" name="Lunghezza"/><br />
  Larghezza  (in cm): <input type="text" name="Larghezza"/><br />
  Profondita (in cm): <input type="text" name="Profondita"/><br />

Riscaldata:
<select name="Riscaldata">
    <option>---</option>
    <option>Si</option>
    <option>No</option>
</select>

Allocazione:
<select name="Allocazione">
    <option>---</option>
    <option>Interna</option>
    <option>Esterna</option>
</select>

Periodo di Apertura:
<select name="PeriodoApertura">
    <option>---</option>
    <option>Annuale</option>
    <option>Estivo</option>
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
