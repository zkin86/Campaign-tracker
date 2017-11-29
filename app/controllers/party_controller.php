<?php
require 'app/models/party.php';
require 'app/models/campaign.php';
class PartyController extends BaseController{

  public static function info($cid, $id){
    $party = Party::find($id);
    $parties = Party::all_for_campaign($cid);
    $campaign = Campaign::find($cid);
    require_once 'app/models/character.php';
    $characters = Character::all_for_party($id);
    View::make('party/party.html', array('attributes' => $campaign, 'party' => $party, 'parties' => $parties, 'characters' => $characters));
  }

  public static function new($id){
    $campaign = Campaign::find($id);
    View::make('party/new.html', array('campaign' => $campaign));
  }

  public static function store($id){
    $params = $_POST;
    $party = new Party(array(
      'name' => $params['name'],
      'kampanja_id' => $id
    ));

    Kint::dump($params);

    $party->save($id);

    Redirect::to('/campaign/'.$id);
  }
}