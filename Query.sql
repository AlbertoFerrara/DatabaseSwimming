
SET FOREIGN_KEY_CHECKS=0;
/*
QUERY
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1)Trovare la/le attività con il maggior numero di partecipanti:
*/

DROP VIEW IF EXISTS NPartecipanti;

CREATE VIEW NPartecipanti (Attivita, NumeroPartecipanti) AS
(SELECT CodAttivita, COUNT(*) AS Partecipanti
FROM Svolgono 
GROUP BY CodAttivita);

SELECT Attivita, NumeroPartecipanti
FROM NPartecipanti
WHERE NumeroPartecipanti=(SELECT MAX(NumeroPartecipanti)
                          FROM NPartecipanti);

/*
+-----------+--------------------+
| Attività  | NumeroPartecipanti |
+-----------+--------------------+
|         1 |                  9 |
|        11 |                  9 |
+-----------+--------------------+
2 rows in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


2)Lista dei bagnini che sorvegliano le piscine dove avviene nuoto per ogni giorno della settimana
*/

SELECT  P.Nome, P.Cognome, PS.Nome, A.Giorno 
FROM Personale P NATURAL JOIN  GestioneSorveglianza GS JOIN Piscine PS ON GS.CodPiscina=PS.CodPiscina JOIN Attività A ON A.Codpiscina=GS.CodPiscina 
WHERE A.Tipo='Nuoto' ORDER BY PS.Nome, A.Giorno;

/*
+--------+------------+----------+--------+
| Nome   | Cognome    | Nome     | Giorno |
+--------+------------+----------+--------+
| Felice | Centofanti | Piscina1 | L      |
| Carla  | Pota       | Piscina1 | L      |
| Felice | Centofanti | Piscina1 | Ma     |
| Carla  | Pota       | Piscina1 | Ma     |
| Felice | Centofanti | Piscina1 | Me     |
| Carla  | Pota       | Piscina1 | Me     |
| Felice | Centofanti | Piscina1 | G      |
| Carla  | Pota       | Piscina1 | G      |
| Felice | Centofanti | Piscina1 | V      |
| Carla  | Pota       | Piscina1 | V      |
| Carla  | Pota       | Piscina1 | D      |
| Felice | Centofanti | Piscina1 | D      |
| Gloria | Morandin   | Piscina2 | S      |
| Carla  | Pota       | Piscina2 | S      |
+--------+------------+----------+--------+
14 rows in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

3) Istruttori con brevetto che scade nell anno in corso
*/

SELECT  p.Cognome, p.Nome
FROM Personale p NATURAL JOIN Istruttori i 
WHERE year(i.ScadenzaBrevetto)=year(current_date());

/*
+---------+----------+
| Cognome | Nome     |
+---------+----------+
| Bello   | Marcello |
+---------+----------+
1 row in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

4)Abbonati che abbiano sottoscritto un abbonamento semestrale e frequentanti della piscina comunale anche di domenica
*/

SELECT distinct c.Cognome, c.Nome
FROM Clienti c NATURAL JOIN Abbonati a NATURAL JOIN Tipoabbonamento t NATURAL JOIN Svolgono s NATURAL JOIN Attivita ai
WHERE t.Durata='Semestrale' and ai.Giorno='D';

/*
+-----------+----------+
| Cognome   | Nome     |
+-----------+----------+
| Ciardi    | Veronica |
| Paparesta | Gianluca |
+-----------+----------+
2 rows in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

5)Determinare le 3 Province che hanno maggior numero di clienti della piscina
*/

SELECT c.LuogoNascita
FROM Clienti c
GROUP BY c.LuogoNascita
ORDER BY COUNT(c.LuogoNascita) DESC
LIMIT 0,3;

/*
+--------------+
| LuogoNascita |
+--------------+
| Padova       |
| Venezia      |
| Treviso      |
+--------------+
3 rows in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

6)Determinare il numero di clienti seguiti da ogni istruttore
*/

DROP VIEW IF EXISTS Clis;

CREATE VIEW Clis (Istruttore, Cliente) AS
SELECT  I.CodiceID, s.CodCliente
FROM Istruttori I LEFT JOIN (Attivita a JOIN Svolgono s ON s.CodAttivita=a.CodAttivita) ON I.CodiceID=a.CodiceID
GROUP BY I.CodiceID, s.CodCliente;

SELECT p.Nome,p.Cognome, COUNT(DISTINCT c.Cliente) AS ClientiSeguiti 
FROM Clis c JOIN Personale p ON c.Istruttore=p.CodiceID
GROUP BY p.Nome,p.Cognome;

/*
+----------+---------+----------------+
| Nome     | Cognome | ClientiSeguiti |
+----------+---------+----------------+
| Antonio  | Cesto   |             29 |
| Ernesto  | Lesto   |              5 |
| Eva      | Rossi   |             11 |
| Federica | Fontana |             39 |
| Marcello | Bello   |             23 |
| Rossana  | Zero    |             20 |
| Samuele  | Melli   |             18 |
+----------+---------+----------------+
7 rows in set (0.00 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

7)Determinare il tipo di attività e il relativo numero dei clienti di sesso femminile che la svogle e
  che compieranno nell’anno corrente un età >= 20 e <= 30
*/

SELECT a.Tipo, COUNT(*) AS Donne
FROM Clienti c NATURAL JOIN Svolgono s NATURAL JOIN Attivita a
WHERE c.Sesso='F' AND year(current_date())-year(c.DataNascita)>=20 AND year(current_date())-year(c.DataNascita)<=30
GROUP BY a.Tipo;

/*
+-------------+-------+
| Tipo        | Donne |
+-------------+-------+
| Aquagym     |     4 |
| Aquatherapy |     4 |
+-------------+-------+
2 rows in set (0.01 sec)

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

8)Numero di attività svolte in una piscina interna il giovedì che ha avuto almeno 5 partecipanti che sono maggiorenni o che compieranno la maggiore età nell’anno corrente 
*/

DROP VIEW IF EXISTS Attivitàgiovedi;

CREATE VIEW Attivitagiovedi AS
SELECT a.Tipo, COUNT(DISTINCT(s.Codcliente)) AS Partecipanti
FROM Svolgono s NATURAL JOIN Clienti c JOIN Attivita a ON s.CodAttivita=a.CodAttivita JOIN Piscine p ON p.CodPiscina=a.CodPiscina
WHERE year(current_date())-year(c.DataNascita)>=18 AND p.Allocazione='Interna' AND a.Giorno='G'
GROUP BY a.Tipo;

SELECT Count(*) AS AttivitaSvolteGiovedì
FROM Attivitagiovedi a
WHERE a.Partecipanti>=5;

/*
+-------------------------+
| AttivitàSvolteGiovedì   |
+-------------------------+
|                       3 |
+-------------------------+
1 row in set (0.00 sec)

9)Impostare che dopo il 5 Giugno di ogni anno l'attività di Acquatherapy si svolgerà all'esterno fino al 15 settembre
*/

UPDATE Attivita
SET Codpiscina=3
WHERE MONTH(current_date())>=6 AND 
      DAY(current_date())>=5 AND 
      MONTH(current_date())<9 AND 
      Tipo='Acquatherapy'; 
  
SET FOREIGN_KEY_CHECKS=1;
