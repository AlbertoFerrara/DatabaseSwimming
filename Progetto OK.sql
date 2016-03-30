USE Esame1;

SET FOREIGN_KEY_CHECKS=0;




DROP TABLE IF EXISTS Segretari;
DROP TABLE IF EXISTS GestioneSorveglianza;
DROP TABLE IF EXISTS Bagnini;
DROP TABLE IF EXISTS Piscine;
DROP TABLE IF EXISTS Istruttori;
DROP TABLE IF EXISTS Svolgono;
DROP TABLE IF EXISTS Attivita;
DROP TABLE IF EXISTS Abbonati;
DROP TABLE IF EXISTS Occasionali;
DROP TABLE IF EXISTS Clienti;
DROP TABLE IF EXISTS TipoAbbonamento;
DROP TABLE IF EXISTS PrezziEntrate;
DROP TABLE IF EXISTS Badge;
DROP TABLE IF EXISTS Personale; 
DROP TABLE IF EXISTS Errori;



CREATE TABLE Personale (
      CodiceID       INT(6)       PRIMARY KEY AUTO_INCREMENT,
      Nome           VARCHAR(10)  NOT NULL,
      Cognome        VARCHAR(10)  NOT NULL,
      DataNascita    DATE,
      LuogoNascita   VARCHAR(20),
      Indirizzo      VARCHAR(30),
      Sesso          ENUM('M','F'),  
      CodiceFiscale  VARCHAR(16),
      RecTelefonico  VARCHAR(11),
      Retribuzione   FLOAT(8)
      ) ENGINE=InnoDB;
       
CREATE TABLE Segretari (
      CodiceID       INT(6)       PRIMARY KEY,      
      Ruolo          VARCHAR(15)  NOT NULL,
      Password       VARCHAR(15)  NOT NULL,
      CONSTRAINT FOREIGN KEY(CodiceID) REFERENCES Personale(CodiceID)
                                       ON DELETE CASCADE
                                       ON UPDATE CASCADE
                            
      ) ENGINE=InnoDB;

CREATE TABLE Istruttori (
      CodiceID               INT(6)       PRIMARY KEY,
      Brevettorilasciatoil   DATE,
      ScadenzaBrevetto       DATE,
      NumeroBrevetto         INT(8)       NOT NULL,
      CONSTRAINT FOREIGN KEY (CodiceID) REFERENCES Personale(CodiceID)
                                        ON DELETE CASCADE
                                        ON UPDATE CASCADE
                            
      ) ENGINE=InnoDB;
       
CREATE TABLE Bagnini (
      CodiceID               INT(6)       PRIMARY KEY,
      Brevettorilasciatoil   DATE,
      ScadenzaBrevetto       DATE,
      NumeroBrevetto         INT(8)       NOT NULL,
      CONSTRAINT FOREIGN KEY (CodiceID) REFERENCES Personale(CodiceID)
                                        ON DELETE CASCADE
                                        ON UPDATE CASCADE
      ) ENGINE=InnoDB;       
  
CREATE TABLE Piscine (
      CodPiscina             INT(6)     PRIMARY KEY  AUTO_INCREMENT,
      Nome                   VARCHAR(15),
      Lunghezza              FLOAT(8),
      Larghezza              FLOAT(8), 
      Profondita             FLOAT(8),
      Riscaldata             ENUM('Si', 'No'),
      Allocazione            ENUM('Interna','Esterna'),
      PeriodoApertura       ENUM('Annuale','Estivo')
      ) ENGINE=InnoDB;
   
CREATE TABLE GestioneSorveglianza (
      CodiceID               INT(6),
      CodPiscina             INT(6),
      PRIMARY KEY (CodiceID, CodPiscina),
      CONSTRAINT FOREIGN KEY (CodiceID) REFERENCES Bagnini(CodiceID)
                                        ON DELETE CASCADE
                                        ON UPDATE CASCADE,
      CONSTRAINT FOREIGN KEY(CodPiscina) REFERENCES Piscine(CodPiscina)     
                                         ON DELETE CASCADE
                                         ON UPDATE CASCADE
      ) ENGINE=InnoDB;

CREATE TABLE Attivita (
      CodAttivita            INT(6)      PRIMARY KEY AUTO_INCREMENT,
      Giorno                 ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'),
      Tipo                   ENUM('Aquagym','Aquatherapy','Aquabuilding','Nuoto') NOT NULL,
      Etaminima              INT(3),
      CodPiscina             INT(6),
      CodiceID               INT(6),
      CONSTRAINT FOREIGN KEY(CodPiscina) REFERENCES Piscine(CodPiscina)
                                         ON DELETE CASCADE
                                         ON UPDATE CASCADE,               
      CONSTRAINT FOREIGN KEY(CodiceID) REFERENCES Istruttori(CodiceID)
                                       ON DELETE CASCADE
                                       ON UPDATE CASCADE
    ) ENGINE=InnoDB;

CREATE TABLE Clienti (
      CodCliente             INT(6)       PRIMARY KEY AUTO_INCREMENT,
      Nome                   VARCHAR(15)  NOT NULL,
      Cognome                VARCHAR(15)  NOT NULL,
      DataNascita            DATE,
      LuogoNascita           VARCHAR(15),
      Sesso                  ENUM('M','F'),
      CodiceFiscale          VARCHAR(16)
      ) ENGINE=InnoDB;

CREATE TABLE Svolgono (
      CodCliente             INT(6),
      CodAttivita            INT(6),
      PRIMARY KEY(CodCliente, CodAttivita),
      CONSTRAINT FOREIGN KEY (CodCliente) REFERENCES Clienti(CodCliente)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE,
      CONSTRAINT FOREIGN KEY (CodAttivita) REFERENCES Attività(CodAttivita)  
                                           ON DELETE CASCADE
                                           ON UPDATE CASCADE                                
      ) ENGINE=InnoDB;

CREATE TABLE TipoAbbonamento (
      CodiceAbb              INT(6)    PRIMARY KEY AUTO_INCREMENT,
      Prezzo                 FLOAT(8)   NOT NULL,
      Durata                 ENUM('Mensile','Semestrale','Annuale')   NOT NULL
      ) ENGINE=InnoDB;

CREATE TABLE PrezziEntrate (
      CodPrezzo               INT(6)    PRIMARY KEY AUTO_INCREMENT,
      Giorno                  ENUM('Feriale','Festivo')   NOT NULL,
      Tipo                    ENUM('Giornaliero','Pomeridiano','Mattutino')    NOT NULL,
      Prezzo                  FLOAT(8)     NOT NULL
      ) ENGINE=InnoDB;

CREATE TABLE Badge (
      CodiceTessera           INT NOT NULL AUTO_INCREMENT, 
      Datascadenza            DATE,
      PRIMARY KEY(CodiceTessera)
      ) ENGINE=InnoDB;

CREATE TABLE Abbonati (
      CodCliente              INT(6)   PRIMARY KEY,
      DataInizio              DATE     NOT NULL,
      DataFine                DATE     NOT NULL,
      Badge                   INT(6)   NOT NULL AUTO_INCREMENT,
      CodiceAbb               INT(6), 
      CONSTRAINT FOREIGN KEY (CodCliente) REFERENCES Clienti(CodCliente)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE,
      CONSTRAINT FOREIGN KEY (Badge) REFERENCES  Badge(CodiceTessera)
                                     ON DELETE CASCADE
                                     ON UPDATE CASCADE,
      CONSTRAINT FOREIGN KEY (CodiceAbb) REFERENCES TipoAbbonamento(CodiceAbb)
                                         ON DELETE CASCADE
                                         ON UPDATE CASCADE
      ) ENGINE=InnoDB;

CREATE TABLE Occasionali (
      CodOccasionale          INT(6) PRIMARY KEY AUTO_INCREMENT,
      CodCliente              INT(6),
      Data_ora_entrata        DATETIME  NOT NULL,
      Prezzo                  INT(6),
      CONSTRAINT FOREIGN KEY (CodCliente) REFERENCES Clienti(CodCliente)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE,
      CONSTRAINT FOREIGN KEY (Prezzo) REFERENCES PrezziEntrate(CodPrezzo)
                                      ON DELETE CASCADE
                                      ON UPDATE CASCADE
      ) ENGINE=InnoDB;


CREATE TABLE Errori (
      Coderr                  INT(6) PRIMARY KEY AUTO_INCREMENT,
      Descrizione             VARCHAR(200)
      ) ENGINE=InnoDB;

INSERT INTO Clienti(Nome, Cognome, DataNascita, LuogoNascita, Sesso, CodiceFiscale) VALUES 
                             ('Marco', 'Mutti', '1990-10-12', 'Venezia','M', 'MTTMRC90R12L736Y' ),
                             ('Omar', 'Utanti', '1987-05-20', 'Venezia','M', 'TNTMRO87E20L736D' ),
                             ('Maria', 'Rossi', '1985-08-02', 'Treviso','F', 'RSSMRA85M42L407Q' ),
                             ('Alberto', 'Mosca', '1984-01-17', 'Vicenza','M', 'MSCLRT84A17L840A'),
                             ('Marzio', 'Auriemma', '1997-06-22', 'Padova','M', 'RMMMRZ97H22G224B'),
                             ('Luisa', 'Scattolin', '1996-09-19', 'Padova','F', 'SCTLSU96P19G224P'),
                             ('Luana', 'Pisa', '1983-02-09', 'Treviso','F', 'PSILNU83B49L407T' ),
                             ('Rossella', 'Brescia', '1997-03-27', 'Vicenza','F', 'BRSRSL97C67L840E'),
                             ('Roberto', 'Baggio', '1978-01-12', 'Treviso','M' ,'BGGRRT78A12L407E'),
                             ('Tommaso', 'Rocchi', '1968-03-21', 'Venezia','M', 'RCCTMS68C21L736Q'),
                             ('Alessia', 'Tedeschi', '1997-10-29', 'Padova','F', 'TDSLSS97R69G224Z'),
                             ('Veronica', 'Ciardi', '1984-03-23', 'Padova','F', 'CRDVNC84C63G224F'),
                             ('Cecilia', 'Capriotti', '1989-10-09', 'Treviso','F', 'CPRCCL89R49L407O'),
                             ('Ciro', 'Mobile', '1997-10-12', 'Venezia','M', 'MBLCRI97R12L736Z'),
                             ('Mauro', 'Toro', '1983-04-09', 'Padova','M', 'TROMRA83D09G224E'),
                             ('Rodolfo', 'Cutolo', '1998-12-09', 'Padova','M', 'CTLRLF98T09G224K'),
                             ('Samuele', 'Zanella', '1995-07-11', 'Venezia','M', 'ZNLSML95L11L736I' ),
                             ('Rosario', 'Muniz', '1977-01-12', 'Padova','M', 'MNZRSR77A12G224X'),
                             ('Andrea', 'Piccoli', '1976-12-17', 'Venezia','M', 'PCCNDR76T17L736S' ),
                             ('Miriam', 'Trevisan', '1977-10-19', 'Venezia','F', 'TRVMRM77R59L407M' ),
                             ('Lorenza', 'Piccoli', '1985-11-29', 'Padova','F', 'PCCLNZ85S69G224V'),
                             ('Raffaella', 'Celeghin', '1997-10-12', 'Treviso','F', 'CLGRLL97R52L407Q' ),
                             ('Paolo', 'Brosio', '1985-11-02', 'Venezia','M', 'BRSPLA85S02L736F'),
                             ('Franco', 'Basso', '1993-01-11', 'Treviso','M', 'BSSFNC93A11L407Q'),
                             ('Manuel', 'Poggiali', '1989-12-05', 'Padova','M', 'PGGMNL89E12G224C'),
                             ('Vincenzo', 'Maggio', '1984-05-07', 'Treviso','M', 'MGGVNZ84E07L407J'),
                             ('Elisabetta', 'Canalis', '1989-03-30', 'Treviso','F', 'LSBCLS89C70L407U' ),
                             ('Gianluca', 'Paparesta', '1977-10-24', 'Padova','M', 'PPRGLC77R24G224Z' ),
                             ('Elia', 'Cagnin', '1989-12-02', 'Padova','M', 'CGNLEI89T02G224Y'), 
                             ('Simone', 'Pepe', '1987-01-10', 'Venezia','M', 'PPESMN87R01L736A'),
                             ('Gianluca', 'Longo', '1997-01-17', 'Venezia','M', 'LNGGLC97A17L736H' ),
                             ('Giuseppe', 'Simone', '1983-04-12', 'Padova','M', 'SMNGPP83D12G224V'),
                             ('Martino', 'Nunziata', '1989-01-19', 'Napoli','M', 'NNZMTN89A19F839M' ),
                             ('Morena', 'Foti', '1980-05-17', 'Vicenza','F', 'FTOMRN80E57L840F' ),
                             ('Milena', 'Miconi', '1996-10-16', 'Padova','F', 'MCNMLN96R56G224Q'),
                             ('Giulia', 'Rosi', '1995-03-13', 'Belluno','F', 'RSOGLI95C53A757H'),
                             ('Marta', 'Pesce', '1997-05-22', 'Padova','F', 'PSCMRT97E62G224F' ),
                             ('Livia', 'Bof', '1987-10-12', 'Vicenza','F', 'BFOLVI87R52L840U' ),
                             ('Marco', 'Pesce', '1990-03-26', 'Treviso','M', 'PSCMRC90C26L407Y' ),
                             ('Maria', 'Stuarda', '1973-04-15', 'Venezia','F', 'STRMRA73D55L736U' ),
                             ('Martina', 'Favaro', '1977-07-19', 'Venezia','F', 'FVRMTN77L59L736Z'),
                             ('Alberto', 'Franceschi', '1992-01-10', 'Padova','M', 'FRNLRT92A10G224G' ),
                             ('Giorgio', 'Summiti', '1950-03-12', 'Padova','M', 'SMMGRG50C12G224E'),
                             ('Marco', 'Summiti', '1970-05-19', 'Padova','M', 'SMMMRC70E19G224E'),
                             ('Franco', 'Ordine', '1987-01-17', 'Venezia','M', 'RDNFNC87A17L736T'),
                             ('Maurizio', 'Mosca', '1947-10-27', 'Treviso','M', 'MSCMRZ47R27L407K'),
                             ('Aldo', 'Biscotto', '1957-10-12', 'Milano','M', 'BSCLDA57R12F205U' ),
                             ('Marina', 'Rei', '1978-03-18', 'Rovigo','F', 'REIMRN78C58H620N'),
                             ('Milly', 'Metti', '1985-12-30', 'Padova','F', 'MTTMLY85T70G224D'),
                             ('Piero', 'Passarotto', '1993-05-19', 'Padova','M', 'PSSPRI95E19G224N' );



/*
POPOLAMENTO TIPOABBONAMENTO OK FINITO
*/

INSERT INTO TipoAbbonamento(Prezzo, Durata) VALUES 
                                     (45, 'Mensile'),
                                     (250, 'Semestrale'),
                                     (400, 'Annuale');

/*
POPOLAMENTO BADGE          OK FATTO
*/

INSERT INTO Badge(Datascadenza) VALUES 
                           ('2016-10-03'),
                           ('2015-01-02'),
                           ('2014-11-13'),
                           ('2014-09-23'),
                           ('2015-01-10'),
                           ('2015-10-03'),
                           ('2015-09-01'),
                           ('2016-01-27'),
                           ('2016-02-13'),
                           ('2015-09-29'),
                           ('2015-09-25'),
                           ('2016-11-23'),
                           ('2015-03-23'),
                           ('2015-09-25'),
                           ('2015-04-15'),
                           ('2016-05-21'),
                           ('2015-04-28'),
                           ('2014-11-20'),
                           ('2015-10-03'),
                           ('2016-03-21'),
                           ('2016-09-03'),
                           ('2016-08-12'),
                           ('2014-10-15'),
                           ('2014-09-13'),
                           ('2014-10-25'),
                           ('2015-04-23'),
                           ('2015-03-23'),
                           ('2015-09-23'),
                           ('2016-03-30'),
                           ('2014-12-23');                             


/*
POPOLAMENTO ABBONATI (30)        OK FATTO
*/

INSERT INTO Abbonati(CodCliente, DataInizio, DataFine, CodiceAbb) VALUES 
                              (1, '2014-05-01', '2014-06-01', 1),
                              (2, '2014-05-12', '2014-06-12', 1),
                              (3, '2014-05-14', '2014-06-14', 1),
                              (4, '2014-05-26', '2014-06-26', 1),
                              (5, '2014-05-12', '2014-06-12', 1),
                              (6, '2014-05-05', '2014-06-05', 1),
                              (7, '2014-05-12', '2014-06-12', 1),
                              (8, '2014-05-12', '2014-06-12', 1),
                              (9, '2014-05-03', '2014-06-03', 1),
                              (10, '2014-05-15', '2014-06-15', 1),
                              (11, '2014-05-16', '2014-06-16', 1),
                              (12, '2014-05-07', '2014-11-07', 2),
                              (13, '2014-05-08', '2014-06-08', 1),
                              (14, '2014-05-09', '2014-06-09', 1),
                              (15, '2014-05-12', '2014-06-12', 1),
                              (16, '2014-05-10', '2014-06-10', 1),
                              (17, '2014-05-02', '2015-05-02', 3),
                              (18, '2014-05-12', '2014-06-12', 1),
                              (19, '2014-05-06', '2014-06-06', 1),
                              (20, '2014-05-10', '2014-06-10', 1),
                              (21, '2014-05-23', '2014-06-23', 1),
                              (22, '2014-05-27', '2015-05-27', 3),
                              (23, '2014-05-29', '2014-06-29', 1),
                              (24, '2014-05-12', '2014-06-12', 1),
                              (25, '2014-05-03', '2014-11-03', 2),
                              (26, '2014-05-12', '2014-06-12', 1),
                              (27, '2014-05-15', '2014-06-15', 1),
                              (28, '2014-05-16', '2014-11-16', 2),
                              (29, '2014-05-17', '2014-06-17', 1),
                              (30, '2014-05-02', '2015-05-02', 3); 


/*
POPOLAMENTO PREZZIENTRATE OK FINITO
*/

INSERT INTO PrezziEntrate(Giorno, Tipo, Prezzo) VALUES 
                                   ('Feriale', 'Giornaliero', 8.00),
                                   ('Feriale', 'Pomeridiano', 5.00),
                                   ('Feriale', 'Mattutino', 4.50),
                                   ('Festivo', 'Giornaliero', 9.00),
                                   ('Festivo', 'Pomeridiano', 6.00),
                                   ('Festivo', 'Mattutino', 5.50);    


/*
POPOLAMENTO OCCASIONALI     OK FATTO
*/

INSERT INTO `Occasionali` VALUES (1, 31, '2014-05-01 09:10:00', 4),
                                 (2, 32, '2014-05-01 10:12:00', 4),
                                 (3, 33, '2014-05-01 09:10:00', 6),
                                 (4, 34, '2014-05-01 11:11:00', 6),
                                 (5, 35, '2014-05-02 09:30:00', 1),
                                 (6, 36, '2014-05-02 14:00:00', 2),
                                 (7, 37, '2014-05-02 10:30:00', 3),
                                 (8, 38, '2014-05-03 09:24:00', 1),
                                 (9, 39, '2014-05-03 15:30:00', 2),
                                 (10, 31, '2014-05-04 10:30:00', 1),
                                 (11, 32, '2014-05-04 09:30:00', 1),
                                 (12, 40, '2014-05-04 09:40:00', 1),
                                 (13, 43, '2014-05-05 14:20:00', 2),
                                 (14, 30, '2014-05-06 09:15:00', 1),
                                 (15, 41, '2014-05-08 09:20:00', 3),
                                 (16, 42, '2014-05-10 15:10:00', 2),
                                 (17, 45, '2014-05-10 15:30:00', 2),
                                 (18, 46, '2014-05-11 09:40:00', 4),
                                 (19, 41, '2014-05-11 09:00:00', 5),
                                 (20, 50, '2014-05-13 14:10:00', 2),
                                 (21, 31, '2014-06-01 09:10:00', 4),
                                 (22, 32, '2014-06-04 10:12:00', 3),
                                 (23, 33, '2014-06-05 09:10:00', 1),
                                 (24, 34, '2014-06-06 11:11:00', 3),
                                 (25, 35, '2014-06-08 09:30:00', 4),
                                 (26, 34, '2014-06-10 14:00:00', 2),
                                 (27, 36, '2014-06-11 10:30:00', 1),
                                 (28, 38, '2014-06-11 09:24:00', 1),
                                 (29, 33, '2014-06-12 15:30:00', 2),
                                 (30, 40, '2014-06-15 10:30:00', 6),
                                 (31, 30, '2014-06-16 09:30:00', 1),
                                 (32, 42, '2014-06-17 09:40:00', 1),
                                 (33, 43, '2014-06-18 14:20:00', 2),
                                 (34, 44, '2014-06-18 09:15:00', 1),
                                 (35, 36, '2014-06-18 09:20:00', 1),
                                 (36, 37, '2014-06-20 15:10:00', 2),
                                 (37, 39, '2014-06-21 15:30:00', 2),
                                 (38, 48, '2014-06-22 09:40:00', 4),
                                 (39, 49, '2014-06-22 09:00:00', 4),
                                 (40, 47, '2014-06-23 14:10:00', 2);
/*
POPOLAMENTO PERSONALE      OK FATTO
*/

INSERT INTO Personale(Nome, Cognome, DataNascita, LuogoNascita, Indirizzo, Sesso, CodiceFiscale, RecTelefonico, Retribuzione) VALUES 
                               ('Marco', 'Azzurri', '1984-04-12', 'Padova', 'Via Roma 34','M', 'ZZRMRC74D12G224E', '0499729800', 1300),
                               ('Michael', 'Bernardi', '1987-01-20', 'Belluno', 'Via Boschi 69','M', 'BRNMHL87A20A757Q', '0437978486', 1400),
                               ('Marco', 'Morassutti', '1989-05-11', 'Venezia', 'Via Dei Numeri 111','M', 'MRSMRC89E11L736X', '0418715801', 1400),
                               ('Antonio', 'Cesto', '1990-07-23', 'Rovigo', 'Via Montello 24','M', 'CSTNTN90L23H620G', '0425729876', 1600),
                               ('Eva', 'Rossi', '1987-04-12', 'Padova', 'Via Verdi 14','F', 'RSSVEA87D52G224D', '0493549350', 1300),
                               ('Marcello', 'Bello', '1970-02-25', 'Vicenza', 'Via Monte Bianco  72','M', 'BLLMCL70B25L840G', '0444972980', 1800),
                               ('Ernesto', 'Lesto', '1964-03-30', 'Venezia', 'Via Dei Re 64','M', 'LSTRST64C30L736C', '0414429860', 1900),
                               ('Rossana', 'Zero', '1987-09-22', 'Belluno', 'Via Dei Remagi 114','F', 'ZRERNN87P62A757W', '0437729867', 1400),
                               ('Federica', 'Fontana', '1984-05-22', 'Treviso', 'Via Luzzatti 24','F', 'FNTFRC84E62L407F', '0422978970', 1400),
                               ('Samuele', 'Melli', '1984-04-12', 'Padova', 'Via Adige 99','M', 'MLLSML84D12G224I', '0499729564', 1500),
                               ('Felice', 'Centofanti', '1978-02-10', 'Padova', 'Via Dei Mille 78','M', 'CNTFLC78B10G224O', '0499745667', 1800),
                               ('Gloria', 'Morandin', '1979-04-12', 'Venezia', 'Via Treviso 15','F', 'MRNGLR79D52L736P', '0415526780', 1700),
                               ('Carla', 'Pota', '1978-08-02', 'Treviso', 'Via Burchiellati 7','F', 'PTOCRL78M42L406L', '0442972671', 1700);


/*
POPOLAMENTO SEGRETARI OK FINITO
*/

INSERT INTO `Segretari` VALUES (1, 'GestioneDB', 1234567890),
                               (2, 'GestioneDB', 1234567890),
                               (3, 'GestioneDB', 1234567890);

/*
POPOLAMENTO ISTRUTTORI          OK FATTO
*/

INSERT INTO `Istruttori` VALUES (4, '2010-03-09', '2017-03-09', 123),
                                (5, '2009-04-09', '2016-04-09', 134),
                                (6, '2007-07-09', '2014-07-09', 165),
                                (7, '2010-09-09', '2017-09-09', 189),
                                (8, '2011-01-09', '2018-01-09', 210),
                                (9, '2010-02-09', '2017-02-09', 122),
                                (10, '2009-09-09', '2016-09-09', 129);

/*
POPOLAMENTO BAGNINI        OK FATTO
*/

INSERT INTO `Bagnini` VALUES (11, '2010-04-09', '2016-04-09', 121),
                             (12, '2011-09-10', '2017-09-10', 120),
                             (13, '2012-03-12', '2018-03-12', 125);

/*
POPOLAMENTO PISCINE        FATTO OK
*/

INSERT INTO Piscine(Nome, Lunghezza, Larghezza, Profondita, Riscaldata, Allocazione, PeriodoApertura) VALUES 
                             ('Piscina1', 10, 4, 2, 'No', 'Interna', 'Annuale'),
                             ('Piscina2', 12, 5, 2, 'No', 'Interna', 'Annuale'),
                             ('Piscina3', 9, 4, 3, 'No', 'Esterna', 'Estivo'),
                             ('Piscina4', 4, 6, 2, 'Si', 'Interna', 'Annuale'),
                             ('Piscina5', 5, 5, 1, 'Si', 'Interna', 'Annuale');
                             

/*
POPOLAMENTO ATTIVITA'   OK FATTO 
*/

INSERT INTO Attivita(Giorno, Tipo, Etaminima, CodPiscina, CodiceID) VALUES 
                              ('Sunday', 'Aquagym', 14, 2, 8),
                              ('Monday', 'Aquagym', 14, 1, 4),
                              ('Tuesday', 'Aquagym', 14, 2, 5),
                              ('Wednesday', 'Aquagym', 14, 2, 8),
                              ('Thursday', 'Aquagym', 14, 1, 5),
                              ('Friday', 'Aquagym', 14, 2, 10),
                              ('Saturday', 'Aquagym', 14, 2, 9),
                              ('Sunday', 'Aquatherapy', 18, 5, 8),
                              ('Monday', 'Aquatherapy', 18, 4, 7),
                              ('Tuesday', 'Aquatherapy', 18, 4, 5),
                              ('Wednesday', 'Aquatherapy', 18, 4, 4),
                              ('Thursday', 'Aquatherapy', 18, 4, 6),
                              ('Friday', 'Aquatherapy', 18, 4, 6),
                              ('Saturday', 'Aquatherapy', 18, 4, 5),                              
                              ('Sunday', 'Aquabuilding', 18, 2, 9),
                              ('Monday', 'Aquabuilding', 18, 2, 9),                              
                              ('Tuesday', 'Aquabuilding', 18, 2, 10),
                              ('Wednesday', 'Aquabuilding', 18, 2, 9),
                              ('Thursday', 'Aquabuilding', 18, 2, 9),                              
                              ('Friday', 'Aquabuilding', 18, 1, 10),
                              ('Saturday', 'Aquabuilding', 18, 2, 9),
                              ('Sunday', 'Nuoto', 14, 1, 6),
                              ('Monday', 'Nuoto', 14, 1, 4),
                              ('Tuesday', 'Nuoto', 14, 1, 4),
                              ('Wednesday', 'Nuoto', 14, 1, 4),
                              ('Thursday', 'Nuoto', 14, 1, 4),                              
                              ('Friday', 'Nuoto', 14, 1, 4),
                              ('Saturday', 'Nuoto', 14, 2, 4);
                             

/*
POPOLAMENTO SVOLGONO    OK FATTO
*/

INSERT INTO `Svolgono` VALUES (1, 1),
                              (1, 21),
                              (1, 24),
                              (2, 2),
                              (2, 28),
                              (2, 20),
                              (3, 3),
                              (3, 27),
                              (3, 20),
                              (3, 25),
                              (3, 14),
                              (4, 1),
                              (4, 12),
                              (4, 16),
                              (4, 19), 
                              (5, 4),
                              (6, 5),
                              (6, 12),
                              (6, 23),
                              (6, 28),
                              (7, 7),
                              (7, 18),
                              (7, 23),
                              (7, 14),
                              (8, 22),
                              (8, 1),
                              (8, 3),
                              (8, 5),
                              (9, 6),
                              (9, 16),
                              (9, 26),
                              (9, 21),
                              (10, 19),
                              (10, 16),
                              (10, 21),
                              (11, 25),
                              (11, 28),
                              (11, 21),
                              (11, 1),
                              (11, 5),
                              (11, 7),
                              (12, 10),
                              (12, 25),
                              (12, 27),
                              (12, 28),
                              (12, 13),
                              (12, 19),
                              (13, 7),
                              (13, 23),
                              (13, 18),
                              (13, 27),
                              (13, 17),
                              (14, 8),
                              (14, 28),
                              (14, 24), 
                              (15, 3),
                              (15, 15),
                              (15, 23),
                              (15, 13),
                              (16, 7),
                              (16, 23),
                              (16, 5),
                              (16, 28),
                              (17, 10),
                              (17, 15),
                              (17, 23),
                              (17, 21),
                              (18, 19),
                              (18, 23),
                              (18, 25),
                              (18, 28),
                              (19, 2),
                              (19, 12),
                              (19, 23),
                              (19, 25),
                              (19, 27),
                              (19, 15),
                              (20, 21),
                              (20, 18),
                              (20, 17),
                              (20, 23),
                              (20, 13),
                              (21, 15),
                              (21, 20),
                              (21, 17),
                              (21, 21),
                              (22, 5),
                              (22, 3),
                              (22, 27),
                              (22, 21),
                              (23, 12),
                              (23, 15),
                              (23, 17),                              
                              (23, 19),
                              (24, 12),
                              (24, 20),                              
                              (24, 22),
                              (24, 18),
                              (25, 10),
                              (25, 18),
                              (25, 19),
                              (26, 11),
                              (26, 21),
                              (26, 17),
                              (26, 12),
                              (27, 10),
                              (27, 21),
                              (27, 25),
                              (28, 1),
                              (28, 8),
                              (28, 24),
                              (28, 21),
                              (28, 19),
                              (29, 2),
                              (29, 28),
                              (29, 12),
                              (29, 21),
                              (30, 6),
                              (30, 9),
                              (30, 10),
                              (30, 13),
                              (30, 26),
                              (30, 19),
                              (31, 28),
                              (31, 7),
                              (31, 22),
                              (32, 8),
                              (32, 14),
                              (32, 7),
                              (32, 28),
                              (32, 18),
                              (33, 9),
                              (33, 27),
                              (33, 14),
                              (33, 21),
                              (34, 3),
                              (34, 24),
                              (34, 21),
                              (34, 15),
                              (35, 11),
                              (35, 14),
                              (35, 18),
                              (35, 21),
                              (36, 11),
                              (36, 5),
                              (36, 9),
                              (36, 26),
                              (36, 19),
                              (37, 5),
                              (37, 1),
                              (37, 22),
                              (37, 26),
                              (38, 12),
                              (38, 10),
                              (38, 17),
                              (38, 14),
                              (38, 21),
                              (39, 11),
                              (39, 20),
                              (40, 8),
                              (40, 14),
                              (40, 28),
                              (40, 15),
                              (41, 7),
                              (41, 27),
                              (41, 14),
                              (41, 20),
                              (42, 6),
                              (42, 26),
                              (43, 5),
                              (43, 15),
                              (44, 7), 
                              (45, 9),
                              (45, 17),
                              (46, 14),
                              (46, 21),
                              (46, 28),
                              (47, 12),
                              (47, 19),
                              (48, 14),
                              (48, 21),
                              (48, 57),
                              (49, 14),
                              (49, 7),
                              (49, 21),
                              (50, 18),
                              (50, 25),
                              (50, 11);


/*
POPOLAMENTO GESTIONESORVEGLIANZA OK FATTO
*/

INSERT INTO `GestioneSorveglianza` VALUES (11, 1),
                                          (12, 2),
                                          (13, 3),
                                          (11, 4),
                                          (13, 5),
                                          (13, 2),
                                          (12, 3),
                                          (13, 1);


/*
POPOLAMENTO TABELLA ERRORI
*/

INSERT INTO Errori(Descrizione) VALUES 
                            ('Data di nascita non rispettata'),
                            ('Tipo Abbonamento non esatto o date Errate'),
                            ('Il cliente non può svolgere quel tipo di Attività in quel Giorno'),
                            ('Cancellazione sorveglianza non avvenuta. Impossibilità di lasciare una piscina senza sorveglianza');



/*TRIGGER
*/

DROP PROCEDURE IF EXISTS ControlloGiorno;
DELIMITER $
CREATE PROCEDURE ControlloGiorno(IN NuovoCliente INT, AttivitaSvolta INT)
BEGIN
IF (SELECT COUNT(*) 
     FROM Occasionali, Attivita
     WHERE Occasionali.Codcliente=NuovoCliente AND Attivita.CodAttivita=AttivitaSvolta AND DAYNAME(Occasionali.Data_ora_entrata)= Attivita.Giorno
 AND Occasionali.CodOccasionale= (SELECT MAX(Occasionali.CodOccasionale)
                              FROM Occasionali, Attivita
                              WHERE Occasionali.Codcliente=NuovoCliente AND Attivita.CodAttivita=AttivitaSvolta))=0 THEN 
 INSERT INTO Errori(Coderr) Values(3);
End IF;
END $
DELIMITER ;


DROP PROCEDURE IF exists Controlloeta;
DELIMITER $
CREATE PROCEDURE Controlloeta(IN NuovoCliente INT, AttivitaSvolta INT)
BEGIN
DECLARE Etaminimatt INT(3);
DECLARE Datanascita date; 
SELECT Attivita.Etaminima, Clienti.DataNascita INTO Etaminimatt, Datanascita
FROM Clienti , Attivita
WHERE Clienti.CodCliente = NuovoCliente AND AttivitaSvolta=Attivita.CodAttivita;

IF ((DATEDIFF(current_date(),DataNascita))/365 < Etaminimatt)
THEN INSERT INTO Errori(Coderr) Values(1);
END IF;
END $
DELIMITER ;


DROP TRIGGER IF EXISTS Controlli;
DELIMITER $
CREATE TRIGGER Controlli
BEFORE INSERT ON Svolgono
FOR EACH ROW
BEGIN
CALL Controlloeta(New.CodCliente,New.CodAttivita);
IF (Select COUNT(*) FROM Abbonati WHERE Abbonati.Codcliente=New.CodCliente)=0 THEN 
CALL ControlloGiorno(New.CodCliente,New.CodAttivita) ;
END IF ;
END $
DELIMITER ;


DROP TRIGGER IF EXISTS ControlloSorveglianza;
DELIMITER $
CREATE TRIGGER ControlloSorveglianza
BEFORE DELETE ON GestioneSorveglianza
FOR EACH ROW
BEGIN

IF(SELECT COUNT(*)AS NumeroSorveglianza
FROM  GestioneSorveglianza
WHERE GestioneSorveglianza.CodPiscina = OLD.CodPiscina)=1 THEN
INSERT INTO Errori(Coderr) VALUES(4);
END IF;
END $
DELIMITER ;



DROP PROCEDURE IF exists ControlloAbbonamento;
DELIMITER $
CREATE PROCEDURE ControlloAbbonamento(IN DataInizio DATE, DataFine DATE, CodiceAbb INT)

BEGIN
DECLARE Mesi_calcolati INT(3);
DECLARE Durata1 VARCHAR(15);

SELECT DATEDIFF(DataFine, DataInizio)/30, TA.Durata INTO Mesi_calcolati, Durata1
FROM TipoAbbonamento TA
WHERE CodiceAbb=TA.CodiceAbb;

IF ((Mesi_calcolati=1 AND Durata1!='Mensile') || 
  (Mesi_calcolati=6 AND Durata1!='Semestrale') || 
  (Mesi_calcolati=12 AND Durata1!='Annuale'))

THEN INSERT INTO Errori(Coderr) Values(2);
END IF;

END $
DELIMITER ;


DROP TRIGGER IF exists CreaBadge;

DELIMITER $
CREATE TRIGGER CreaBadge
BEFORE INSERT ON Abbonati
FOR EACH ROW
BEGIN


CALL ControlloAbbonamento(NEW.DataInizio, NEW.DataFine, NEW.CodiceAbb);

INSERT INTO Badge(Datascadenza) VALUES(current_date() + INTERVAL 3 YEAR);


END $
DELIMITER ;


SET FOREIGN_KEY_CHECKS=1;
