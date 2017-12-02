<?php
require 'app/models/character.php';
require 'app/models/party.php';
require 'app/models/campaign.php';

class CharacterController extends BaseController{

  public static function store($cid, $pid){
  	if(!isset($_SESSION['user'])){
      Redirect::to('/kirjautuminen', array('error' => 'Kirjaudu ensin sisään!'));
    }
	$params = $_POST;
    $character = new character(array(
    'name' => $params['name'],
    'pname' => $params['pname'],
    'party' => Party::find($pid),
    'class' => $params['class'],
    ));
    Kint::dump($params);
    $campaign->save();

    Redirect::to('/campaign');
  }

  public static function new($cid, $pid){
  	if(!isset($_SESSION['user'])){
      Redirect::to('/kirjautuminen', array('error' => 'Kirjaudu ensin sisään!'));
    }
    require_once 'app/models/character_class.php';
    $classes = CharacterClass::all();
  	View::make('character/new.html', array('classes' => $classes));
  }

  public static function info($cid, $pid, $id){
  	if(!isset($_SESSION['user'])){
      Redirect::to('/kirjautuminen', array('error' => 'Kirjaudu ensin sisään!'));
    }
    $parties = Party::all_for_campaign($cid);
    $party = Party::find($pid);
    $characters = Character::all_for_party($pid);
    $character = Character::find($id);
    $campaign = Campaign::find($cid);
    if(!is_null($character)) {
    	if($character->party->id==$pid) {
    		View::make('character/character.html', array('campaign' => $campaign, 'parties' => $parties, 'party' => $party, 'characters' => $characters, 'character' => $character));
    	}
    }


    Redirect::to('/campaign/'.$cid.'/'.$pid, array('error' => 'Hups, yritit urkkia ryhmään kuulumattoman hahmon tietoja!'));
  }
}
