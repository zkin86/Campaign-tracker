-- Lisää INSERT INTO lauseet tähän tiedostoon
-- testidata puuttuu toistaiseksi
INSERT INTO Omistaja(name, password)
VALUES ('Eerikki', 'kalasana');

INSERT INTO Omistaja(name, password)
VALUES ('testaaja', 'erittäinvaikeasalasana');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (1, 'testikampanja');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (1, 'testikampanja2');

INSERT INTO Kampanja(omistaja_id, name)
VALUES (2, 'testikampanja3');