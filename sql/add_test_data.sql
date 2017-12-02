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

INSERT INTO Ryhma(omistaja_id, name)
VALUES (1, 'testiryhmä');

INSERT INTO Ryhma(omistaja_id, name)
VALUES (1, 'testiryhmä2');

INSERT INTO Ryhma(omistaja_id, name)
VALUES (1, 'testiryhmä3');

INSERT INTO KampanjanRyhma(kampanja_id, ryhma_id)
VALUES (1,1);

INSERT INTO KampanjanRyhma(kampanja_id, ryhma_id)
VALUES (1,2);

INSERT INTO KampanjanRyhma(kampanja_id, ryhma_id)
VALUES (2,3);

INSERT INTO Hahmoluokka(name) VALUES ('Brute');

INSERT INTO Hahmoluokka(name) VALUES ('Scoundrel');

INSERT INTO Hahmoluokka(name) VALUES ('Spellweaver');

INSERT INTO Hahmoluokka(name) VALUES ('Mindthief');

INSERT INTO Hahmoluokka(name) VALUES ('Tinkerer');

INSERT INTO Hahmoluokka(name) VALUES ('Cragheart');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name, kulta) VALUES (1,1,'Brutus', 'Pertti Pelaaja', 60);

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name, taso) VALUES (1,2,'Epatto valapatto', 'Mauno mato', 2);

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,1,'Brutus', 'joku muu');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,5,'temppuilija', 'joku toinen');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,3,'taikuri', 'kuka muu');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (2,4,'aivorotta', 'nimellinen');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (3,3,'taikahämis', 'nimetön');

INSERT INTO Hahmo(ryhma_id, hahmoluokka_id, hahmo_name, pelaaja_name) VALUES (3,4,'lempivaras', 'testipelaaja');
