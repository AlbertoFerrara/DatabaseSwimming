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
<h1>  Seleziona tabella <br> per effettuare la cancellazione </h1>
<table width="100%" CELLSPACING="50" align="center">
    <tr><h3>
       <td align="center" ><h1><a href="CancPersonale.php">Personale</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="CancCliente.php">Clienti</a></h1></td>
    </tr>
    <tr>
       <td align="center" ><h1><a href="CancAttivita.php">Attività</a></h1></td>
    </tr>
   <tr>
       <td align="center" ><h1><a href="CancSorveglianza.php">Sorveglianza Piscina</a></h1></td>
    </tr>
   <tr>
      <form action="HomeAmministrazione.php" >
      <td align="center"><input type="submit" value="BACK" /></td>
      </form
    </tr>

</table>
</font> 
</BODY>
</HTML>

<?
}
?>
