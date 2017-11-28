<?php
require 'app/models/character.php';
require 'app/models/party.php';
require 'app/models/campaign.php';

class CharacterController extends BaseController{
//  public static function index($pid, $id){
//    $party = Party::find($pid);
//    $characters = Character::all_for_party($pid);
//    $character = Character::find($id);
//    View::make('character/index.html', array('party' => $party, 'characters' => $characters, 'character' => $character));
//  }

//  public static function store(){
//	  $params = $_POST;
//    $campaign = new Campaign(array(
//      'name' => $params['name'],
//      'omistaja_id' => self::get_user_logged_in()->id
//    ));
//    Kint::dump($params);
//    $campaign->save();
//
//    Redirect::to('/campaign');
//  }
//  public static function new(){
//  	View::make('campaign/new.html');
//  }
//
//  public static function edit($id){
//    $campaign = Campaign::find($id);
//    View::make('campaign/edit.html', array('attributes' => $campaign));
//  }

  public static function info($cid, $pid, $id){
    $parties = Party::all_for_campaign($cid);
    $characters = Character::all_for_party($pid);
    $character = Character::find($id);
    $campaign = Campaign::find($cid);
    View::make('character/character.html', array('attributes' => $campaign, 'parties' => $parties, 'characters' => $characters, 'character' => $character));
  }

//  public static function destroy($id) {
//    Campaign::delete($id);
//    Redirect::to('/campaign', array('message' => 'Tuhosit juuri kampanjan pysyvästi'));
//  }
}
