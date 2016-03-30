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

if (basename($_SERVER['HTTP_REFERER'])!='VisClienti.php?' and basename($_SERVER['HTTP_REFERER'])!='VisSvolgono.php?' and basename($_SERVER['HTTP_REFERER'])!='VisOccasionali.php?')
 { 
 $CodAtt=(int)$_POST['AttSvolta'];
 $link=$_POST['link'];
if ($link=='InserimentoOccasionali.php?')
 {$Nome = $_POST['Nome']; 
  $Cognome = $_POST['Cognome'];
  $DataNascita=$_POST['DataNascita'];
  $LuogoNascita=$_POST['LuogoNascita'];
  $CodiceFiscale=$_POST['CodiceFiscale'];
  $Sesso=$_POST['Sesso'];
  $InsCliente=mysql_query("INSERT INTO Clienti(Nome, Cognome, DataNascita, LuogoNascita,Sesso,CodiceFiscale) VALUES 
                           ('$Nome' ,'$Cognome','$DataNascita','$LuogoNascita','$Sesso','$CodiceFiscale')");
  if (!$InsCliente)
   die('Errore nella query:' .mysql_error());
  $query=mysql_query("SELECT Max(CodCliente) As CodCliente FROM Clienti");
  $row=mysql_fetch_array($query);
  $Data_ora_entrata=$_POST['Data_ora_entrata'];
  $Prezzo=(int)$_POST['Prezzo']; 
  $InsOccasionali=mysql_query("INSERT INTO Occasionali(CodCliente, Data_ora_entrata, Prezzo) VALUES 
                           ('$row[CodCliente]' ,'$Data_ora_entrata','$Prezzo')");
   if (!$InsOccasionali)
      {$Elcliente=mysql_query("DELETE FROM Clienti where CodCliente=$row[CodCliente]");
       die("Errore nella query");}
  $CodCliente=$row['CodCliente'];
  $InsSvolgono=mysql_query("INSERT INTO Svolgono VALUES 
                           ($CodCliente,$CodAtt)");
  if (!$InsSvolgono)
  {if(mysql_error()=="Duplicate entry '3' for key 'PRIMARY'")
   echo 'Il cliente non può svolgere quel tipo di Attività in quel Giorno';
   if(mysql_error()=="Duplicate entry '1' for key 'PRIMARY'")
   echo 'Eta non idonea per svolgere questa attivita';
   $Elcliente=mysql_query("DELETE FROM Clienti where CodCliente=$row[CodCliente]");
   $ClienteOccInserito=mysql_query("Select Max(CodOccasionale) As Cod From Occasionali where CodCliente=$CodCliente");
    $row=mysql_fetch_array($ClienteOccInserito);
    $Elocc=mysql_query("DELETE FROM Occasionali where CodCliente=$row[Cod]");
   echo "   
 <form action=InserimentoOccasionali.php>
  <input type=submit value=BACK />
  </form> " ;  
 }
  else
    {     
  echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisClienti.php">
  <td><input type="submit" value="VisualizzaCliente" /></td>
  </form> 
  <form action="VisOccasionali.php">
  <td><input type="submit" value="VisualizzaOccasionale" /></td>
  </form> 
  <form action="VisSvolgono.php">
  <td><input type="submit" value="VisualizzaAttSvolta" /></td>
  </form> 
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;
}
 }
  
 if ($link=='InserimentoOcc.php' or $link=='InserimentoOcc.php?')
 {
  $CodCliente=(int)$_POST['Svolgono'];
  $Data_ora_entrata=$_POST['Data_ora_entrata'];
  $Prezzo=(int)$_POST['Prezzo']; 
  $InsOccasionali=mysql_query("INSERT INTO Occasionali(CodCliente, Data_ora_entrata, Prezzo) VALUES 
                           ('$CodCliente' ,'$Data_ora_entrata','$Prezzo')");
  if (!$InsOccasionali)
     die(" ". mysql_error()); 
  $InsSvolgono= mysql_query("INSERT INTO Svolgono VALUES 
                           ('$CodCliente','$CodAtt')");
  if (!$InsSvolgono)
   {
   if(mysql_error()=="Duplicate entry '3' for key 'PRIMARY'")
   echo 'Il cliente non può svolgere quel tipo di Attività in quel Giorno';
   if(mysql_error()=="Duplicate entry '1' for key 'PRIMARY'")
   echo 'Eta non idonea per svolgere questa attivita';
   $ClienteOccInserito=mysql_query("Select Max(CodOccasionale) As Cod From Occasionali where CodCliente=$CodCliente");
    if (!$ClienteOccInserito)
     echo(" ". mysql_error());
   $row=mysql_fetch_array($ClienteOccInserito);
   $Elocc=mysql_query("DELETE FROM Occasionali where CodCliente=$row[Cod]");
 echo "   
 <form action=InserimentoOcc.php>
  <input type=submit value=BACK />
  </form> " ;
}
  else
  {
 echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisOccasionali.php">
  <td><input type="submit" value="VisualizzaOccasionale" /></td>
  </form> 
  <form action="VisSvolgono.php">
  <td><input type="submit" value="VisualizzaAttSvolta" /></td>
  </form> 
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;
  } 
 }
 if ($link=='InserimentoSvolgono.php' or $link=='InserimentoSvolgono.php?')
   {$CodCliente=(int)$_POST['Svolgono'];
   $InsSvolgono = mysql_query("INSERT INTO Svolgono VALUES 
                           ('$CodCliente','$CodAtt')");
   if (!$InsSvolgono){
  echo "   
 <form action=InserimentoSvolgono.php>
  <input type=submit value=BACK />
  </form> " ;
      if(mysql_error()=="Duplicate entry '1' for key 'PRIMARY'")
   die('Eta non idonea per svolgere questa attivita');
 if(mysql_error()=="Duplicate entry '3' for key 'PRIMARY'")
   die('Il cliente non può svolgere quel tipo di Attività in quel Giorno');}
echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisSvolgono.php">
  <td><input type="submit" value="Visualizza" /></td>
  </form>   
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;
  }
}

if (basename($_SERVER['HTTP_REFERER'])=='VisSvolgono.php?')
 {
echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisSvolgono.php">
  <td><input type="submit" value="Visualizza" /></td>
  </form>   
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;
}
if (basename($_SERVER['HTTP_REFERER'])=='VisClienti.php?')
 {
  echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisClienti.php">
  <td><input type="submit" value="VisualizzaCliente" /></td>
  </form> 
  <form action="VisOccasionali.php">
  <td><input type="submit" value="VisualizzaOccasionale" /></td>
  </form> 
  <form action="VisSvolgono.php">
  <td><input type="submit" value="VisualizzaAttSvolta" /></td>
  </form> 
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;
}
if (basename($_SERVER['HTTP_REFERER'])=='VisOccasionali.php?')
 {
  echo<<<END
  Inserimento Avvenuto Correttamente<br>Seleziona una delle seguenti operazioni:
  <table><tr>
  <form action="VisOccasionali.php">
  <td><input type="submit" value="VisualizzaOccasionale" /></td>
  </form> 
  <form action="VisSvolgono.php">
  <td><input type="submit" value="VisualizzaAttSvolta" /></td>
  </form> 
  <form action="HomeAmministrazione.php">
  <td><input type="submit" value="Home" /></td></tr></table>
  </form>   
END;

}
}
?>


