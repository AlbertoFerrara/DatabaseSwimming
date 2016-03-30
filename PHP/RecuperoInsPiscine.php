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
if (basename($_SERVER['HTTP_REFERER'])!='ModPiscine.php' and basename($_SERVER['HTTP_REFERER'])!='VisPiscine.php?')
{$Nome = $_POST['Nome'];
$Lunghezza = $_POST['Lunghezza'];
$Larghezza = $_POST['Larghezza'];
$Profondita= $_POST['Profondita'];
$Riscaldata = $_POST['Riscaldata'];
$Allocazione = $_POST['Allocazione'];
$PeriodoApertura = $_POST['PeriodoApertura'];



$InsPiscina=mysql_query("INSERT INTO Piscine(Nome, Lunghezza, Larghezza, Profondita, Riscaldata, Allocazione, PeriodoApertura) VALUES 
                           (\"$Nome\",\"$Lunghezza\", \"$Larghezza\",\"$Profondita\",\"$Riscaldata\",\"$Allocazione\",\"$PeriodoApertura\")");
					

if(!$InsPiscina) 
die("Errore nella query: " . mysql_error());
}
   
	$query=mysql_query("SELECT Max(CodPiscina) as CodPiscina FROM Piscine");  
        $row=mysql_fetch_array($query); 
	echo "Piscina Inserita Correttamente <br />";
	echo<<<END
	Scegli una delle seguenti operazioni:
        <table>
        <tr>
        <form action="ModPiscine.php"  method="POST"> 
        <input type="hidden" name="CodPiscina" value="$row[CodPiscina]">
        <td><input type="submit" value="MODIFICA INSERIMENTO" /></td>
        </form>
        <form action="VisPiscine.php" align="left">
        <td><input type="submit" value="VISUALIZZA"/></td>
        </form>
        <form action="HomeAmministrazione.php"  method="POST">
        <td><input type="submit" value="HOME" /></td></tr></table>
        </form> 
	
END;
	
}
	
?>

						   
