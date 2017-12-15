-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Omistaja(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL UNIQUE,
  password varchar(50) NOT NULL
);

CREATE TABLE Kampanja(
  id SERIAL PRIMARY KEY,
  omistaja_id INTEGER REFERENCES Omistaja(id),
  name varchar(50) NOT NULL,
  prosperity INTEGER NOT NULL DEFAULT 1
);


CREATE TABLE Ryhma(
  id SERIAL PRIMARY KEY,
  omistaja_id INTEGER REFERENCES Omistaja(id) ON DELETE CASCADE,
  name varchar(50) NOT NULL,
  perustettu DATE DEFAULT CURRENT_DATE
);

CREATE TABLE KampanjanRyhma(
  kampanja_id INTEGER REFERENCES Kampanja(id) ON DELETE CASCADE NOT NULL,
  ryhma_id INTEGER REFERENCES Ryhma(id) ON DELETE CASCADE NOT NULL
);

CREATE TABLE Hahmoluokka(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);

CREATE TABLE Hahmo(
  id SERIAL PRIMARY KEY,
  ryhma_id INTEGER REFERENCES Ryhma(id) ON DELETE CASCADE,
  hahmoluokka_id INTEGER REFERENCES Hahmoluokka(id) ON DELETE CASCADE,
  hahmo_name varchar(50) NOT NULL,
  pelaaja_name varchar(50) NOT NULL,
  kulta INTEGER NOT NULL DEFAULT 30,
  exp INTEGER NOT NULL DEFAULT 0,
  taso INTEGER NOT NULL DEFAULT 1
);
--myöhemmin toteuttetavat taulut
--CREATE TABLE K_saavutus(
--  id SERIAL PRIMARY KEY,
--  name varchar(50) NOT NULL
--);

--CREATE TABLE KampanjanSaavutus(
-- kampanja_id INTEGER REFERENCES Kampanja(id) DELETE ON CASCADE,
-- saavutus_id INTEGER REFERENCES K_saavutus(id) DELETE ON CASCADE
--);

--CREATE TABLE R_saavutus(
-- id SERIAL PRIMARY KEY,
-- name varchar(50) NOT NULL
--);

--CREATE TABLE RyhmanSaavutus(
-- ryhma_id INTEGER REFERENCES Ryhma(id) DELETE ON CASCADE,
-- saavutus_id INTEGER REFERENCES R_saavutus(id) DELETE ON CASCADE
--);

--CREATE TABLE Skenaario(
-- id SERIAL PRIMARY KEY,
-- name varchar(50) NOT NULL
--);

--CREATE TABLE Historia(
--  skenaario_id INTEGER REFERENCES Skenaario(id),
--  Kampanja_id INTEGER REFERENCES Kampanja(id),
--  played DATE NOT NULL DEFAULT CURRENT_DATE
--);
