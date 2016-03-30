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
{$CodiceID = $_POST['CodiceID'];
$CodPiscina = (int)$_POST['Cod'];

$InsGest=mysql_query("INSERT INTO GestioneSorveglianza VALUES 
                           ('$CodiceID','$CodPiscina')");
if(!$InsGest) 
die("Errore nella query: " . mysql_error());
}
 
        
	echo "Attivita inserita correttamente<br />";
        echo<<<END
        Scegli una delle seguenti operazioni:
        <table>
        <tr>
        <form action="VisGestioneSor.php" align="left">
        <td><input type="submit" value="VISUALIZZA"/></td>
        </form>
        <form action="HomeAmministrazione.php"  method="POST">
        <td><input type="submit" value="HOME" /></td></tr></table>
        </form> 
END;
}

?>
