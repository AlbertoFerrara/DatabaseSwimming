<?php
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
<h1>  Seleziona tabella <br> da visualizzare </h1>
<table width="90%" CELLSPACING="30" align="left">
    <tr>
       <td align="center" ><h1><a href="VisSegretari.php">Segretari</a></h1></td>
       <td align="center" ><h1><a href="VisBagnini.php">Bagnini</a></h1></td>
       <td align="center" ><h1><a href="VisPersonale.php">Personale</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="VisIstruttori.php">Istruttori</a></h1></td>
       <td align="center" ><h1><a href="VisGestioneSor.php">GestioneSorveglianza</a></h1></td>
       <td align="center" ><h1><a href="VisPiscine.php">Piscine</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="VisAttivita.php">Attività</a></h1></td>
       <td align="center" ><h1><a href="VisSvolgono.php">Svolgono</a></h1></td>
       <td align="center" ><h1><a href="VisClienti.php">Clienti</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="VisAbbonati.php">Abbonati</a></h1></td>
       <td align="center" ><h1><a href="VisOccasionali.php">Occasionali</a></h1></td>
       <td align="center" ><h1><a href="VisBadge.php">Badge</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="VisTipoA.php">TipoAbbonamento</a></h1></td>
       <td><form action="HomeAmministrazione.php" align="center">
       <input type="submit" value="Back"/>
       </form></td>
       <td align="center" ><h1><a href="VisPrezzi.php">PrezziEntrate</a></h1></td>
    </tr>

</table>
</font>
</BODY>
</HTML>

<?php
}
?>
