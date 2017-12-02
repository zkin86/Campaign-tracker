<?php
class User extends BaseModel{
  public $id, $name, $password;
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  public static function authenticate($username, $password){
    $query = DB::connection()->prepare('SELECT * FROM Omistaja WHERE name = :username AND password = :password LIMIT 1');
    $query->execute(array('username' => $username, 'password' => $password));
    $row = $query->fetch();

    if($row){
    $user = new User(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));

      return $user;
    }
    else{
      return null;
    }
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Omistaja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $user = new user(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password'],
      ));

      return $user;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Omistaja(name, password) VALUES (:name, :password);');
    $query->execute(array('name' => $this->name, 'password' => $this->password));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
    
    //$this->id = $row['id'];
  }

  public static function used($username){
    $query = DB::connection()->prepare('SELECT * FROM Omistaja WHERE name=:name;');
    $query->execute(array('name' => $username));
    $row = $query->fetch();
    if($row) {
      return True;
    }
    return False;
  }
}