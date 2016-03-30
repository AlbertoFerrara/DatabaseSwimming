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
if (basename($_SERVER['HTTP_REFERER'])!='VisPersonale.php?') 
{$CodiceID=(int)$_REQUEST['CodiceID'];
$query=mysql_query("DELETE FROM Personale WHERE CodiceID=\"$CodiceID\" ");

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
echo<<<END
    Eliminazione avvenuta<br><table><tr><td>Scegli un'operazione:</td>
   <form action="HomeAmministrazione.php" >
   <td><input type="submit" value="HOME" /></td>
   </form>
    <form action="VisPersonale.php" >
   <td><input type="submit" value="CONTROLLA ELIMINAZIONE" /></td></tr>
   </table>
   </form>
END;


}
?>
