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
if (basename($_SERVER['HTTP_REFERER'])!='VisAttivita.php?') 
{$CodAttivita=$_REQUEST['CodAttivita'];
$query=mysql_query("DELETE FROM Attivita WHERE CodAttivita=\"$CodAttivita\" ");

if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
  echo<<<END
    Eliminazione avvenuta<br><table><tr><td>Scegli un'operazione:</td>
   <form action="HomeAmministrazione.php" >
   <td><input type="submit" value="HOME" /></td>
   </form>
    <form action="VisAttivita.php" >
   <td><input type="submit" value="CONTROLLA ELIMINAZIONE" /></td></tr>
   </table>
   </form>
END;
}
?>
