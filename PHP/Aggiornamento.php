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
<h1>  Seleziona tabella <br> per effettuare l'aggiornamento </h1>
<table width="100%" CELLSPACING="10" align="left">
    <tr><h3>
       <td align="center" ><h1><a href="AggPersonale.php">Personale</a></h1></td>
       <td align="left" ><h1><a href="AggBagnini.php">Bagnini</a></h1></td>
       <td align="left" ><h1><a href="AggIstruttori.php">Istruttori</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="AggCliente.php">Clienti</a></h1></td> 
       <td align="left" ><h1><a href="AggOccasionali.php">Occasionali</a></h1></td> 
        <td align="left" ><h1><a href="AggAbb.php">Abbonati</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="AggSvolgono.php">Svolgono</a></h1></td> 
       <td align="left" ><h1><a href="AggAttivita.php">Attività</a></h1></td>
       <td align="left" ><h1><a href="AggBadge.php">Badge</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="AggGest.php">Gestione Sorveglianza</a></h1></td>
       <td align="left" ><h1><a href="AggPiscine.php">Piscine</a></h1></td>
       <td align="left" ><h1><a href="AggPrezziEntrate.php">PrezziEntrate</a></h1></td>
    </tr>
   <tr>
       <td align="center" ><h1><a href="AggAbbonamento.php">Abbonamenti</a></h1></td>
       <td align="center" ><form action="HomeAmministrazione.php" align="left">
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
