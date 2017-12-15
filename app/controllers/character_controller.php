<?php
require 'app/models/character.php';
require 'app/models/party.php';
require 'app/models/campaign.php';

class CharacterController extends BaseController{

  public static function store($cid, $pid){
    self::check_logged_in();
    $params = $_POST;
    $character = new Character(array(
      'name' => $params['name'],
      'pname' => $params['pname'],
      'party' => Party::find($pid),
      'luokka' => CharacterClass::find($params['class']),
    ));
    Kint::dump($params);
    $character->save();

    Redirect::to('/campaign/'.$cid.'/'.$pid);
  }

  public static function new($cid, $pid){
    self::check_logged_in();
    $party = Party::find($pid);
    require_once 'app/models/character_class.php';
    $classes = CharacterClass::all();
  	View::make('character/new.html', array('classes' => $classes, 'party' => $party));
  }

  public static function info($cid, $pid, $id){
    self::check_logged_in();
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

  public static function edit($cid, $pid, $chid){
    self::check_logged_in();
    $character = Character::find($chid);

    if(!is_null($character)) {
      if($character->party->id==$pid) {
        View::make('character/edit.html', array( 'character' => $character));
      }
    }

    Redirect::to('/campaign/'.$cid, array('error' => 'Hups, yritit urkkia kampanjaan kuulumattoman ryhmän tietoja'));
  }

  public static function destroy($chid) {
    self::check_logged_in();
    $params =$_POST;
    $character = Character::find($chid);
    Character::delete($character->id);
    Redirect::to('/campaign/'.$party->kampanja->id, array('message' => 'Poistit juuri hahmon ' . $character->name .' pysyvästi!'));
  }

  public static function update($cid, $pid, $id) {
    self::check_logged_in();
    $params = $_POST;
    $character = new Character(array(
      'name' => $params['name'],
      'id' => $id,
      'lvl' => $params['level'],
      'exp' => $params['exp'],
      'gold' => $params['gold']
    ));

    Kint::dump($params);

    $character->update();

    Redirect::to('/campaign/'.$cid.'/'.$pid, array('message' => 'Muokkasit hahmoa '  . $character->name .'!'));
  }
}
