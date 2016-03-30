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
if (basename($_SERVER['HTTP_REFERER'])!='ModAttivita.php' and basename($_SERVER['HTTP_REFERER'])!='VisAttivita.php?')
{$Giorno = $_POST['Giorno'];
$Tipo = $_POST['Tipo'];
$Etaminima = $_POST['Etaminima'];
$CodPiscina= (int)$_POST['CodPiscina'];
$CodiceID = (int)$_POST['CodiceID'];


$InsAttivita=mysql_query("INSERT INTO Attivita(Giorno, Tipo, Etaminima, CodPiscina, CodiceID) VALUES 
                           ('$Giorno','$Tipo', '$Etaminima','$CodPiscina','$CodiceID')");
if(!$InsAttivita) 
die("Errore nella query: " . mysql_error());
}
 
        $TrovaCodInserito=mysql_query("SELECT MAX(CodAttivita) As CodAtt FROM Attivita");
        $row=mysql_fetch_array($TrovaCodInserito);
	echo "Attivita inserita correttamente<br />";
        echo<<<END
        Scegli una delle seguenti operazioni:
        <table>
        <tr>
        <form action="ModAttivita.php"  method="POST"> 
        <input type="hidden" name="CodAttivita" value="$row[CodAtt]">
        <td><input type="submit" value="MODIFICA INSERIMENTO" /></td>
        </form>
        <form action="VisAttivita.php" align="left">
        <td><input type="submit" value="VISUALIZZA"/></td>
        </form>
        <form action="HomeAmministrazione.php"  method="POST">
        <td><input type="submit" value="HOME" /></td></tr></table>
        </form> 
END;
}

?>

						   
