<?php
class Campaign extends BaseModel{
  public $id, $omistaja_id, $name, $prosperity;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Kampanja ORDER BY name DESC');
    $query->execute();
    $rows = $query->fetchAll();
    $campaigns = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $campaigns[] = new Campaign(array(
        'id' => $row['id'],
        'omistaja_id' => $row['omistaja_id'],
        'name' => $row['name'],
        'prosperity' => $row['prosperity'],
      ));
    }

    return $campaigns;
  }

  public static function all_for_user($id) {
    $query = DB::connection()->prepare('SELECT * FROM Kampanja WHERE omistaja_id = :id ORDER BY name');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();
    $campaigns = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $campaigns[] = new Campaign(array(
        'id' => $row['id'],
        'omistaja_id' => $row['omistaja_id'],
        'prosperity' => $row['prosperity'],
        'name' => $row['name'],
      ));
    }

    return $campaigns;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Kampanja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => intval($id)));
    $row = $query->fetch();

    if($row){
      $campaign = new Campaign(array(
        'id' => $row['id'],
        'omistaja_id' => $row['omistaja_id'],
        'name' => $row['name'],
        'prosperity' => $row['prosperity'],
      ));

      return $campaign;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Kampanja(omistaja_id, name) VALUES (:omistaja_id, :name);');
    $query->execute(array('name' => $this->name, 'omistaja_id' => $this->omistaja_id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);

    //$this->id = $row['id'];
  }

  public static function delete($id){
    $query = DB::connection()->prepare('DELETE FROM KampanjanRyhma WHERE kampanja_id = :id');
    $query->execute(array('id' => $id));
    $query = DB::connection()->prepare('DELETE FROM KampanjanSaavutus WHERE kampanja_id = :id');
    $query->execute(array('id' => $id));
    $query = DB::connection()->prepare('DELETE FROM Kampanja WHERE id = :id');
    $query->execute(array('id' => $id));
  }

  public function update() {
    $query = DB::connection()->prepare('UPDATE Kampanja SET name =:name, prosperity=:prosperity WHERE id = :id;');
    $query->execute(array('name' => $this->name, 'prosperity' => $this->prosperity, 'id' => $this->id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
  }


}
