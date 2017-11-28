<?php
class Character extends BaseModel{
  public $id, $luokka, $name, $pname;// $kulta, $taso, $exp;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function all(){
    $query = DB::connection()->prepare('SELECT Hahmoluokka.name AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmoluokka.id=Hahmo.hahmoluokka_id');
    $query->execute();
    $rows = $query->fetchAll();
    $characters = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $characters[] = new Character(array(
        'luokka' => $row['luokka'],
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function all_for_party($pid) {
    $query = DB::connection()->prepare('SELECT Hahmoluokka.name AS luokka, Hahmo.hahmo_name AS name, Hahmo.pelaaja_name AS pname FROM Hahmo LEFT JOIN Hahmoluokka ON Hahmo.hahmoluokka_id=Hahmoluokka.id WHERE Hahmo.ryhma_id = :pid');
    $query->execute(array('pid' => $pid));
    $rows = $query->fetchAll();
    $characters = array();

    foreach($rows as $row){
      $characters[] = new Character(array(
        'luokka' => $row['luokka'],
        'name' => $row['name'],
        'pname' => $row['pname'],
      ));
    }

    return $characters;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Hahmo WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $character = new Character(array(
        'luokka' => $row['luokka'],
        'name' => $row['name'],
        'pname' => $row['pname'],
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
