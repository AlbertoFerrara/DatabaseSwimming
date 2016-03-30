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
if (basename($_SERVER['HTTP_REFERER'])!='VisAbbonati.php?' and basename($_SERVER['HTTP_REFERER'])!='ModAbb.php' )
{$Nome = $_POST['Nome'];
$Cognome = $_POST['Cognome'];
$DataNascita = $_POST['DataNascita'];
$LuogoNascita= $_POST['LuogoNascita'];
$Sesso= $_POST['Sesso'];
$CodiceFiscale = $_POST['CodiceFiscale'];
$DataInizio = $_POST['DataInizio'];
$DataFine = $_POST['DataFine'];
$CodiceAbb = (int)$_POST['CodiceAbb'];
 

$InsClienti=mysql_query("INSERT INTO Clienti(Nome,Cognome,DataNascita,LuogoNascita,Sesso,CodiceFiscale) VALUES 
                           ('$Nome','$Cognome','$DataNascita','$LuogoNascita','$Sesso','$CodiceFiscale')");

$querycod=mysql_query("SELECT MAX(CodCliente) As CodCliente FROM Clienti");
$row = mysql_fetch_array($querycod);	            
 
    if (!$InsClienti) 
       die("Inserimento Cliente Fallito :" . mysql_error());
    else{ 	
    $InsAbbonati=mysql_query("INSERT INTO Abbonati(CodCliente, DataInizio, DataFine, CodiceAbb) VALUES 
                           ('$row[CodCliente]' ,'$DataInizio','$DataFine','$CodiceAbb')");					 
    if (!$InsAbbonati)
      {
echo"
 <form action=InserimentoAbbonati.php >
    <input type=submit value=BACK />
</form>";
     if(mysql_error()=="Duplicate entry '2' for key 'PRIMARY'")
      {$EliCliente=mysql_query("DELETE FROM Clienti WHERE CodCliente=$row[CodCliente] ");
      die ('Tipo Abbonamento non esatto o date Errate');
      }
    }}}
    echo 'Inserimento Abbonato avvenuto<br>Scegli un operazione:';
     $querycod=mysql_query("SELECT MAX(CodCliente) As CodCliente FROM Clienti");
     $row = mysql_fetch_array($querycod); 
    
echo<<<END
      <table><tr>
     <form action="ModAbb.php" method="POST"> <input type="hidden" name="CodCliente" value="$row[CodCliente]"><td><input type="submit" value="MODIFICA DATI ABBONATO INSERITO" /></td></form>
      <form action="VisAbbonati.php"><td><input type="submit" value="VISUALIZZA DATI ABBONATO" /></td></form><form action="HomeAmministrazione.php"  method="POST"><td><input type="submit" value="HOME" /></td></tr></form>  
END;

}
?>

						   
