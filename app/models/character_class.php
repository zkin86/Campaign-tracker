<?php
class CharacterClass extends BaseModel{
	public $id, $name; 
  	public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all() {
    $query = DB::connection()->prepare('SELECT * FROM Hahmoluokka;');
    $query->execute();
    $rows = $query->fetchAll();
    foreach($rows as $row){
      $classes[] = new CharacterClass(array(
      	'name'=> $row['name'],
      	'id' => $row['id'],
      ));
    }

    return $classes;
  }

  public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Hahmoluokka WHERE id=:id LIMIT 1;');
    $query->execute(array( 'id'=> $id));
    $row = $query->fetch();
    if($row){
      $luokka = new CharacterClass(array(
        'name' => $row['name'],
        'id' => $row['id'],
      ));
    }
    return $luokka;
  }

}
