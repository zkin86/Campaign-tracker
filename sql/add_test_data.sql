-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Omistaja(name, password)
VALUES ('testaaja', 'erittäinvaikeasalasana');

INSERT INTO Omistaja(name, password)
VALUES ('eerikki', 'kalasana');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (1, 'testikampanja');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (1, 'testikampanja2');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (2, 'testikampanja3');

INSERT INTO Ryhma(kampanja_id, name)
VALUES (1, 'testiryhmä');

INSERT INTO Ryhma(kampanja_id, name)
VALUES (2, 'testiryhmä2');

INSERT INTO Ryhma(kampanja_id, name)
VALUES (2, 'testiryhmä3');

INSERT INTO Hahmoluokka(name) VALUES ('Brute');

INSERT INTO Hahmoluokka(name) VALUES ('Scoundrel');

INSERT INTO Hahmoluokka(name) VALUES ('Spellweaver');

INSERT INTO Hahmoluokka(name) VALUES ('Mindthief');

INSERT INTO Hahmoluokka(name) VALUES ('Tinkerer');

INSERT INTO Hahmoluokka(name) VALUES ('Craighart');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (1,1,'Brutus', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (1,2,'Epatto valapatto', 'Mauno mato');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,1,'Brutus', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,5,'temppuilija', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,3,'taikuri', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,4,'aivorotta', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (3,3,'Brutus', 'Pertti Pelaaja');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (3,4,'Brutus', 'Pertti Pelaaja');
