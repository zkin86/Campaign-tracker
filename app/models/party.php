<?php
class Party extends BaseModel{
  public $id, $kampanja_id, $name;
  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Ryhma WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $party = new Party(array(
        'id' => $row['id'],
        'kampanja_id' => $row['kampanja_id'],
        'name' => $row['name'],
      ));

      return $party;
    }

    return null;
  }

  public static function all_for_campaign($cid) {
    $query = DB::connection()->prepare('SELECT * FROM Ryhma WHERE kampanja_id = :cid');
    $query->execute(array('cid' => $cid));
    $rows = $query->fetchAll();
    $parties = array();

    foreach($rows as $row){
      $parties[] = new Party(array(
        'id' => $row['id'],
        'kampanja_id' => $row['kampanja_id'],
        'name' => $row['name'],
      ));
    }

    return $parties;
  }

  public function save($kampanja_id){
    $query = DB::connection()->prepare('INSERT INTO Ryhma(kampanja_id, name) VALUES (:kampanja_id, :name);');
    $query->execute(array('name' => $this->name, 'kampanja_id' => $kampanja_id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
    
    //$this->id = $row['id'];
  }
}