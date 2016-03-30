<?php

$connessione=mysql_connect('basidati', 'aferrara', 'zq0IINMw')
  or die($_SERVER['PHP_SELF'] . "Connessione fallita!");
  
mysql_select_db('aferrara-ES', $connessione);

?>
