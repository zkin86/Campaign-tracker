-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Omistaja(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Kampanja(
  id SERIAL PRIMARY KEY,
  omistaja_id INTEGER REFERENCES Omistaja(id),
  name varchar(50) NOT NULL
);

CREATE TABLE Ryhma(
  id SERIAL PRIMARY KEY,
  kampanja_id INTEGER REFERENCES Kampanja(id),
  name varchar(50) NOT NULL,
  perustettu DATE
);

CREATE TABLE Hahmoluokka(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);

CREATE TABLE Hahmo(
  id SERIAL PRIMARY KEY,
  ryhma_id INTEGER REFERENCES Ryhma(id),
  hahmoluokka_id INTEGER REFERENCES Hahmoluokka(id),
  hahmo_name varchar(50) NOT NULL,
  pelaaja_name varchar(50) NOT NULL,
  tarina varchar(400),
  added DATE
);


--tällä hetkellä rahmo on sidottu tiettyyn ryhmään, voisi toteuttaa myös seuraavanlaisella liitostaululla jolloin luotua hahmoa voisi pelata missä tahansa ryhmässä, pelin säännöt eivät ehkä salli tätä tapausta
--CREATE TABLE RyhmanHahmo(
--  ryhma_id INTEGER REFERENCES Ryhma(id),
--  hahmo_id INTEGER REFERENCES Hahmo(id),
--);

CREATE TABLE Historia(
  id SERIAL PRIMARY KEY,
  Kampanja_id INTEGER REFERENCES Kampanja(id),
  skenaario_name varchar(50) NOT NULL,
  played DATE
);

--puuttuu taulut tavaroille, kampanjan ja ryhmien saavutuksille sekä liitostaulut hahmojen tavaroille ja kampanjan ja ryhmien saavutuksille, yhteensä 12 taulua