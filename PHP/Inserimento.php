<?
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
?>

<HTML>
<HEAD>
<Style type="text/css">
body {background-image:url(swimming.jpg); text-align:center; }
@font-face {
   font-family: 'BlackRose';
   src: url('BLACKR~1.ttf') format('truetype');}
</Style>
</HEAD>
<BODY>
<font face="BlackRose" size=5>
<h1>  Seleziona tabella <br> per effettuare l inserimento </h1>
<table width="100%" CELLSPACING="50" align="center">
    <tr>
       <td align="center" ><h1><a href="InserimentoPersonale.php">Personale</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="InserimentoClienti.php">Clienti</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="InserimentoOcc.php">Occasionali Registrati</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="InserimentoAttivita.php">Attivita</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="InserimentoPiscine.php">Piscine</a></h1></td>
    </tr>
   <tr>
       <td align="center" ><h1><a href="InserimentoSvolgono.php">Attivita Svolta</a></h1></td>
    </tr>
      <tr>
       <td align="center" ><h1><a href="InserimentoGest.php">Sorveglianza</a></h1></td>
    </tr>
    <tr><td>
       <form action="HomeAmministrazione.php" align="center">
       <input type="submit" value="Back"/>
       </form></td>
    </tr>

</table>
</font> 
</BODY>
</HTML>


<?
}
?>

