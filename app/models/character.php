<?php
require 'app/models/character_class.php';
class Character extends BaseModel{
  public $id, $party, $luokka, $name, $pname, $gold, $lvl, $exp;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function all(){
    $query = DB::connection()->prepare('SELECT Hahmo.id AS id, Hahmoluokka.id AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmoluokka.id=Hahmo.hahmoluokka_id');
    $query->execute();
    $rows = $query->fetchAll();
    $characters = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $characters[] = new Character(array(
        'id' => $row['id'],
        'luokka' => CharacterClass::find($row['luokka']),
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function all_for_party($pid) {
    $query = DB::connection()->prepare('SELECT Hahmo.id AS id, Hahmoluokka.id AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmo.hahmoluokka_id=Hahmoluokka.id WHERE Hahmo.ryhma_id = :pid');
    $query->execute(array('pid' => intval($pid)));
    $rows = $query->fetchAll();
    $characters = array();
    require_once 'app/models/party.php';
    $party = Party::find($pid);

    foreach($rows as $row){
      $characters[] = new Character(array(
        'id' => $row['id'],
        'party' => $party,
        'luokka' => CharacterClass::find($row['luokka']),
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmo.hahmoluokka_id=Hahmoluokka.id WHERE Hahmo.id = :id');
    $query->execute(array('id' => intval($id)));
    $row = $query->fetch();

    if($row){
      $character = new Character(array(
        'party' => Party::find($row['ryhma_id']),
        'id' => $id,
        'luokka' => CharacterClass::find($row['hahmoluokka_id']),
        'name' => $row['hahmo_name'],
        'gold' => $row['kulta'],
        'exp' => $row['exp'],
        'lvl' => $row['taso'],
      ));

      return $character;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Hahmo(hahmo_name, pelaaja_name, ryhma_id, hahmoluokka_id) VALUES(:name, :pname, :pid, :class_id);');
    $query->execute(array('name' => $this->name, 'pname' => $this->pname, 'pid' => $this->party->id, 'class_id' => $this->luokka->id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
  }

  public static function delete($id){
    $query = DB::connection()->prepare('DELETE FROM Hahmo WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  public function update() {
    $query = DB::connection()->prepare('UPDATE Hahmo SET hahmo_name =:name, taso=:lvl, kulta=:gold, exp=:exp WHERE id = :id;');
    $query->execute(array('name' => $this->name, 'lvl' => $this->lvl, 'gold' => $this->gold, 'exp' => $this->exp, 'id' => $this->id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
  }
}
