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
<h1>   Amministrazione </h1>
<h2> Seleziona un'operazione </h2>
<table width="100%" CELLSPACING="50" align="center">
    <tr><h3>
       <td align="center" ><h1><a href="Inserimento.php">Inserimento</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="Aggiornamento.php">Aggiornamento</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="Cancellazione.php">Cancellazione</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="Visualizzazione.php">Visualizzazione</a></h1></td>
    </tr>
</table>
</font> 

<a href="logout.php">LOGOUT</a></h2>
</BODY>
</HTML>
<?
}
?>


