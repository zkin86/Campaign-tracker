<?php 

class UserController extends BaseController{
  public static function login(){
      View::make('user/login.html');
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
    }
  }

  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/kirjautuminen', array('message' => 'Olet kirjautunut ulos!'));
  }

  public static function new(){
    View::make('user/new.html');
  }

  public static function store(){
    $params = $_POST;

    $user = new User(array(
        'name' => $params['username'],
        'password' => $params['password']
    ));

    if($params['password']==$params['passwordcheck'] and !User::used($user->name)) {

     Kint::dump($params);

      $user->save();

      Redirect::to('/', array('message' => 'Tervetuloa Gloomhaven-kampanjaträkkerin käyttäjäksi '  . $user->name . '!'));
    }

    if($params['password']!=$params['passwordcheck']) {
      $error = 'Kirjoita salasana uudelleen';
    }

    if(User::used($user->name)) {
      $error = 'Käyttäjänimi on varattu, valitse uusi';
    }

    View::make('user/new.html', array('error' => $error, 'username' => $params['username']));
  }
  
}