<?php
require 'app/models/party.php';
require 'app/models/campaign.php';
class PartyController extends BaseController{

  public static function info($cid, $id){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $party = Party::find($id);

    if(!is_null($party)) {
      if($party->kampanja->omistaja_id==self::get_user_logged_in()->id) {
        $parties = Party::all_for_campaign($cid);
        require_once 'app/models/character.php';
        $characters = Character::all_for_party($id);
        View::make('party/party.html', array('attributes' => $party->kampanja, 'party' => $party, 'parties' => $parties, 'characters' => $characters));
      }
    }

    Redirect::to('/campaign/'.$cid, array('error' => 'Hups, yritit urkkia sinulle kuulumattoman ryhmän tietoja'));
  }

  public static function new($id){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $campaign = Campaign::find($id);
    View::make('party/new.html', array('campaign' => $campaign));
  }

  public static function store($id){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $params = $_POST;
    $party = new Party(array(
      'name' => $params['name'],
      'kampanja' => Campaign::find($id)
    ));

    Kint::dump($params);

    $party->save($id);

    Redirect::to('/campaign/'.$id);
  }
}