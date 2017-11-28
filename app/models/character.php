<?php
class Character extends BaseModel{
  public $id, $party, $luokka, $name, $pname, $gold, $lvl, $exp;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function all(){
    $query = DB::connection()->prepare('SELECT Hahmo.id AS id, Hahmoluokka.name AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmoluokka.id=Hahmo.hahmoluokka_id');
    $query->execute();
    $rows = $query->fetchAll();
    $characters = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $characters[] = new Character(array(
        'id' => $row['id'],
        'luokka' => $row['luokka'],
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function all_for_party($pid) {
    $query = DB::connection()->prepare('SELECT Hahmo.id AS id, Hahmoluokka.name AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmo.hahmoluokka_id=Hahmoluokka.id WHERE Hahmo.ryhma_id = :pid');
    $query->execute(array('pid' => $pid));
    $rows = $query->fetchAll();
    $characters = array();
    require_once 'app/models/party.php';
    $party = Party::find($pid);

    foreach($rows as $row){
      $characters[] = new Character(array(
        'id' => $row['id'],
        'party' => $party,
        'luokka' => $row['luokka'],
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmo.hahmoluokka_id=Hahmoluokka.id WHERE Hahmo.id = :id');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $character = new Character(array(
	'id' => $id,
        'name' => $row['hahmo_name'],
        'gold' => $row['kulta'],
        'exp' => $row['exp'],
        'lvl' => $row['taso'],
      ));

      return $character;
    }

    return null;
  }

//  public function save(){
//    $query = DB::connection()->prepare('INSERT INTO Kampanja(omistaja_id, name) VALUES (:omistaja_id, :name);');
//    $query->execute(array('name' => $this->name, 'omistaja_id' => $this->omistaja_id));
//    $row = $query->fetch();
//    Kint::trace();
//    Kint::dump($row);
    
    //$this->id = $row['id'];
//  }

//  public static function delete($id){
//    $query = DB::connection()->prepare('DELETE FROM Kampanja WHERE id = :id');
//    $query->execute(array('id' => $id));
//  }
}
