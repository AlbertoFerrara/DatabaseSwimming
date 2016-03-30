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
if (basename($_SERVER['HTTP_REFERER'])!='VisGestioneSor.php?') 
{$CodiceID=$_REQUEST['CodiceID'];
 $CodPiscina=(int)$_REQUEST['CodPiscina'];
$query=mysql_query("DELETE FROM GestioneSorveglianza WHERE CodiceID=\"$CodiceID\" and CodPiscina='$CodPiscina' ");

if (!$query) {
   echo"
 <form action=CancSorveglianza.php >
    <input type=submit value=BACK />
</form>";
     if(mysql_error()=="Duplicate entry '4' for key 'PRIMARY'");
     die ("Cancellazione sorveglianza non avvenuta. Impossibilita di lasciare una piscina senza sorveglianza");
 
}
}
echo<<<END
    Eliminazione avvenuta<br><table><tr><td>Scegli un'operazione:</td>
   <form action="HomeAmministrazione.php" >
   <td><input type="submit" value="HOME" /></td>
   </form>
    <form action="VisGestioneSor.php" >
   <td><input type="submit" value="CONTROLLA ELIMINAZIONE" /></td></tr>
   </table>
   </form>
END;


}
?>
