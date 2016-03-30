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
if (basename($_SERVER['HTTP_REFERER'])!='VisIstruttori.php' and basename($_SERVER['HTTP_REFERER'])!='VisBagnini.php')
{$Nome = $_POST['Nome'];
$Cognome = $_POST['Cognome'];
$DataNascita = $_POST['DataNascita'];
$LuogoNascita= $_POST['LuogoNascita'];
$Indirizzo = $_POST['Indirizzo'];
$CodiceFiscale = $_POST['CodiceFiscale'];
$RecTelefonico = $_POST['RecTelefonico'];
$Retribuzione = $_POST['Retribuzione'];
$Sesso = $_POST['Sesso'];
$Ruolo= $_POST['Ruolo'];
$Brevettorilasciatoil= $_POST['Brevettorilasciatoil'];
$ScadenzaBrevetto= $_POST['ScadenzaBrevetto'];
$NumeroBrevetto= $_POST['NumeroBrevetto'];

$InsPersonale=mysql_query("INSERT INTO Personale(Nome, Cognome, DataNascita, LuogoNascita, Indirizzo, Sesso, CodiceFiscale, RecTelefonico, Retribuzione) VALUES 
                           ('$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$CodiceFiscale','$RecTelefonico','$Retribuzione')");
}						  
$querycod=mysql_query("SELECT MAX(CodiceID) As CodiceID FROM Personale");
$row = mysql_fetch_array($querycod);
    if (basename($_SERVER['HTTP_REFERER'])!='VisIstruttori.php' and basename($_SERVER['HTTP_REFERER'])!='VisBagnini.php')
    {				   
     if (!$InsPersonale) 
       die("Inseriento Personale Fallito:" . mysql_error());
     else
     { 		
      if ($Ruolo=='Bagnino')
	{$InsBagnini= mysql_query("INSERT INTO Bagnini VALUES ('$row[CodiceID]' ,'$Brevettorilasciatoil', '$ScadenzaBrevetto','$NumeroBrevetto')");
        if (!$InsBagnini)
         {$EliPersonale=mysql_query("DELETE FROM Personale WHERE CodiceID=$row[CodiceID] ");
          die("Inseriento Bagnino Fallito: " . mysql_error()); }
        else 
        {echo 'Inserimento Bagnino avvenuto<br> Scegli un operazione:';
         echo<<<END
        <form action="VisBagnini.php"  method="POST"> 
        <table><tr><td>
        <input type="submit" value="VISUALIZZA BAGNINO INSERITO" /></td>
        </form>
        <form action="HomeAmministrazione.php"  method="POST">
        <td><input type="submit" value="HOME" /></td></tr></table>
        </form> 
END;
}}
     else
       {$InsIstruttori= mysql_query("INSERT INTO Istruttori VALUES ('$row[CodiceID]' ,'$Brevettorilasciatoil', '$ScadenzaBrevetto','$NumeroBrevetto')");
        if (!$InsIstruttori)
         {die("Inseriento Istruttore Fallito: " . mysql_error());
         $EliPersonale=mysql_query("DELETE FROM Personale WHERE CodiceID=$row[CodiceID]");}
        else    
       {echo "Inserimento Istruttore avvenuto<br>Scegli un operazione:";
       echo<<<END
       <form action="VisIstruttori.php"  method="POST"> 
       <table><tr><td>
       <input type="submit" value="VISUALIZZA ISTRUTTORE INSERITO" /></td>
       </form> 
       <form action="HomeAmministrazione.php"  method="POST">
       <td><input type="submit" value="HOME" /></td></tr></table>
       </form> 
END;
}}}}
if (basename($_SERVER['HTTP_REFERER'])=='VisIstruttori.php')
echo<<<END
       Inserimento Istruttore avvenuto<br>Scegli un operazione:
       <form action="VisIstruttori.php"  method="POST"> 
       <table><tr><td>
       <input type="submit" value="VISUALIZZA ISTRUTTORE INSERITO" /></td>
       </form> 
       <form action="HomeAmministrazione.php"  method="POST">
       <td><input type="submit" value="HOME" /></td></tr></table>
       </form> 
END;
if (basename($_SERVER['HTTP_REFERER'])=='VisBagnini.php')
echo<<<END
        Inserimento Bagnino avvenuto<br>Scegli un operazione:
        <form action="VisBagnini.php"  method="POST"> 
        <table><tr><td>
        <input type="submit" value="VISUALIZZA BAGNINO INSERITO" /></td>
        </form>
        <form action="HomeAmministrazione.php"  method="POST">
        <td><input type="submit" value="HOME" /></td></tr></table>
        </form> 
END;
}
?>
