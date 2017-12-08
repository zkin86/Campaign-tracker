<?php
class Party extends BaseModel{
  public $id, $kampanja, $name;
  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT Ryhma.id AS id, Ryhma.name AS name, KampanjanRyhma.kampanja_id AS kampanja_id FROM Ryhma LEFT JOIN KampanjanRyhma ON Ryhma.id = KampanjanRyhma.ryhma_id WHERE id = :id LIMIT 1;');
    $query->execute(array('id' => intval($id)));
    $row = $query->fetch();
    if($row){
      require_once 'app/models/campaign.php';
      $party = new Party(array(
        'id' => $row['id'],
        'kampanja' => Campaign::find($row['kampanja_id']),
        'name' => $row['name'],
      ));

      return $party;
    }

    return null;
  }

  public static function all_for_campaign($cid) {
    $query = DB::connection()->prepare('SELECT Ryhma.id AS id, Ryhma.name AS name, KampanjanRyhma.kampanja_id AS kampanja_id FROM Ryhma LEFT JOIN KampanjanRyhma ON Ryhma.id = KampanjanRyhma.ryhma_id WHERE kampanja_id = :cid;');
    $query->execute(array('cid' => intval($cid)));
    $rows = $query->fetchAll();
    $parties = array();

    foreach($rows as $row){
      require_once 'app/models/campaign.php';
      $parties[] = new Party(array(
        'id' => $row['id'],
        'kampanja' => Campaign::find($row['kampanja_id']),
        'name' => $row['name'],
      ));
    }

    return $parties;
  }

  public static function all_for_owner_not_in_campaign($cid) {
    $query = DB::connection()->prepare('SELECT Ryhma.id AS id, Ryhma.name AS name, KampanjanRyhma.kampanja_id AS kampanja_id FROM Ryhma LEFT JOIN KampanjanRyhma ON Ryhma.id = KampanjanRyhma.ryhma_id WHERE Ryhma.omistaja_id = :omistaja_id AND kampanja_id != :cid;');
    require_once 'app/models/campaign.php';
    $query->execute(array('cid' => intval($cid), 'omistaja_id' => Campaign::find($cid)->omistaja_id));
    $rows = $query->fetchAll();
    $parties = array();

    foreach($rows as $row){
      require_once 'app/models/campaign.php';
      $parties[] = new Party(array(
        'id' => $row['id'],
        'kampanja' => Campaign::find($row['kampanja_id']),
        'name' => $row['name'],
      ));
    }

    return $parties;
  }

  public function save($kampanja_id){
    $query = DB::connection()->prepare('INSERT INTO Ryhma(name) VALUES (:name);');
    $query->execute(array('name' => $this->name));
    $query = DB::connection()->prepare('SELECT id FROM Ryhma WHERE name=:name ORDER BY Perustettu DESC LIMIT 1;');
    $query->execute(array('name' => $this->name));
    $row = $query->fetch();
    $pid=$row['id'];
    $query = DB::connection()->prepare('INSERT INTO KampanjanRyhma(kampanja_id, ryhma_id) VALUES (:kampanja_id, :ryhma_id)');
    $query->execute(array('kampanja_id' => $kampanja_id,'ryhma_id' => $pid));


    Kint::trace();
    Kint::dump($row);
    
    //$this->id = $row['id'];
  }
  public static function delete($id){
    $query = DB::connection()->prepare('DELETE FROM KampanjanRyhma WHERE ryhma_id = :id');
    $query->execute(array('id' => $id));
    $query = DB::connection()->prepare('DELETE FROM RyhmanSaavutus WHERE ryhma_id = :id');
    $query->execute(array('id' => $id));
    $query = DB::connection()->prepare('DELETE FROM Hahmo WHERE ryhma_id = :id');
    $query->execute(array('id' => $id));
    $query = DB::connection()->prepare('DELETE FROM Ryhma WHERE id = :id');
    $query->execute(array('id' => $id));
  }

}