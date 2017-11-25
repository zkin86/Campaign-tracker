-- Lisää INSERT INTO lauseet tähän tiedostoon
-- testidata puuttuu toistaiseksi

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