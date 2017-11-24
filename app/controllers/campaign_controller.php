<?php
require 'app/models/campaign.php';
class CampaignController extends BaseController{
  public static function index(){
    $campaigns = Campaign::all();
    View::make('campaign/index.html', array('campaigns' => $campaigns));
  }

  public static function store(){
    $user = self::get_user_logged_in();
	  $params = $_POST;
    $campaign = new Campaign(array(
      'name' => $params['name'],
      'omistaja_id' => $user['id']
    ));

    Kint::dump($params);

    $campaign->save();

    Redirect::to('/campaign');
  }
  public static function new(){
  	View::make('campaign/new.html');
  }
}