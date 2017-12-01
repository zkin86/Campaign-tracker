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

    Redirect::to('/campaign');
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
    require_once 'app/models/party.php';
    $parties = Party::all_for_campaign($id);
    View::make('campaign/campaign.html', array('attributes' => $campaign, 'parties' => $parties));
  }

  public static function destroy($id) {
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
    Campaign::delete($id);
    Redirect::to('/campaign', array('message' => 'Tuhosit juuri kampanjan pysyvästi'));
  }
}