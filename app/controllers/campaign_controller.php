<?php
require 'app/models/campaign.php';
class CampaignController extends BaseController{

  public static function index(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    } else {$campaigns = Campaign::all_for_user(self::get_user_logged_in()->id);
    }
    $campaigns = Campaign::all_for_user(self::get_user_logged_in()->id);
    View::make('campaign/index.html', array('campaigns' => $campaigns));
  }

  public static function store(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    } else {$omistaja = self::get_user_logged_in()->id;
    }
	  $params = $_POST;
    $campaign = new Campaign(array(
      'name' => $params['name'],

      'omistaja_id' => $omistaja
    ));

    Kint::dump($params);

    $campaign->save();

    Redirect::to('/campaign', array('message' => 'Loit juuri uuden kampanjan '  . $campaign->name . '!'));
  }

  public static function new(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
  	View::make('campaign/new.html');
  }

  public static function edit($id){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $campaign = Campaign::find($id);
    View::make('campaign/edit.html', array('attributes' => $campaign));
  }

  public static function info($id){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $campaign = Campaign::find($id);
    if(!is_null($campaign)) {
      if($campaign->omistaja_id==self::get_user_logged_in()->id) {

      require_once 'app/models/party.php';
      $parties = Party::all_for_campaign($id);
      View::make('campaign/campaign.html', array('attributes' => $campaign, 'parties' => $parties));
      }
    }

    Redirect::to('/campaign', array('error' => 'Hups, yritit urkkia sinulle kuulumattoman kampanjan tietoja'));
  }

  public static function destroy($id) {
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $campaign = Campaign::find($id);
    Campaign::delete($id);
    Redirect::to('/campaign', array('message' => 'Poistit juuri kampanjan ' . $campaign->name .' pysyvästi!'));
  }

  public static function update($id) {
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    $params = $_POST;
    $campaign = new Campaign(array(
      'name' => $params['name'],
      'id' => $id
    ));

    Kint::dump($params);

    $campaign->update();

    Redirect::to('/campaign/'.$id, array('message' => 'Muokkasit kampanjaa '  . $campaign->name .'!'));
  }

}