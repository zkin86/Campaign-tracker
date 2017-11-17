<?php
class Campaign extends BaseModel{
  public $id, $omistaja_id, $name;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Kampanja');
    $query->execute();
    $rows = $query->fetchAll();
    $campaigns = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $campaigns[] = new Campaign(array(
        'id' => $row['id'],
        'omistaja_id' => $row['omistaja_id'],
        'name' => $row['name'],
      ));
    }

    return $campaigns;
  }
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Kampanja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $game = new Game(array(
        'id' => $row['id'],
        'omistaja_id' => $row['omistaja_id'],
        'name' => $row['name'],
      ));

      return $campaign;
    }

    return null;
  }
}