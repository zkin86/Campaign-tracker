<?php
require 'app/models/party.php';
require 'app/models/campaign.php';
class PartyController extends BaseController{

  public static function info($cid, $id){
    self::check_logged_in();
    $party = Party::find($id);

    if(!is_null($party)) {
      if($party->kampanja->id==$cid) {
        $parties = Party::all_for_campaign($cid);
        require_once 'app/models/character.php';
        $characters = Character::all_for_party($id);
        View::make('party/party.html', array('campaign' => $party->kampanja, 'party' => $party, 'parties' => $parties, 'characters' => $characters));
      }
    }

    Redirect::to('/campaign/'.$cid, array('error' => 'Hups, yritit urkkia kampanjaan kuulumattoman ryhmän tietoja'));
  }

  public static function new($id){
    self::check_logged_in();
    $campaign = Campaign::find($id);
    $parties = Party::all_for_owner_not_in_campaign($id);
    View::make('party/new.html', array('campaign' => $campaign, 'parties' => $parties));
  }

  public static function store($id){
    self::check_logged_in();
    $params = $_POST;
    $party = new Party(array(
      'name' => $params['name'],
      'kampanja' => Campaign::find($id)
    ));

    Kint::dump($params);

    $party->save($id);

    Redirect::to('/campaign/'.$id);
  }

  public static function edit($cid, $id){
    self::check_logged_in();
    $party = Party::find($id);

    if(!is_null($party)) {
      if($party->kampanja->id==$cid) {
        require_once 'app/models/character.php';
        $characters = Character::all_for_party($id);
        View::make('party/edit.html', array('party' => $party, 'characters' => $characters));
      }
    }

    Redirect::to('/campaign/'.$cid, array('error' => 'Hups, yritit urkkia kampanjaan kuulumattoman ryhmän tietoja'));
  }

  public static function destroy($id) {
    self::check_logged_in();
    $params =$_POST;
    $party = Party::find($params['pid']);
    Party::delete($party->id);
    Redirect::to('/campaign/'.$party->kampanja->id, array('message' => 'Poistit juuri Ryhmän ' . $party->name .' pysyvästi!'));
  }
}
