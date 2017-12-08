<?php
require 'app/models/campaign.php';
class CampaignController extends BaseController{

  public static function index(){
    self::check_logged_in();
    $campaigns = Campaign::all_for_user(self::get_user_logged_in()->id);
    View::make('campaign/index.html', array('campaigns' => $campaigns));
  }

  public static function store(){
    self::check_logged_in();
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
    self::check_logged_in();
  	View::make('campaign/new.html');
  }

  public static function edit($id){
    self::check_logged_in();
    $campaign = Campaign::find($id);
    View::make('campaign/edit.html', array('campaign' => $campaign));
  }

  public static function info($id){
    self::check_logged_in();
    $campaign = Campaign::find($id);
    if(!is_null($campaign)) {
      if($campaign->omistaja_id==self::get_user_logged_in()->id) {

      require_once 'app/models/party.php';
      $parties = Party::all_for_campaign($id);
      View::make('campaign/campaign.html', array('campaign' => $campaign, 'parties' => $parties));
      }
    }

    Redirect::to('/campaign', array('error' => 'Hups, yritit urkkia sinulle kuulumattoman kampanjan tietoja'));
  }

  public static function destroy($id) {
    self::check_logged_in();
    $campaign = Campaign::find($id);
    Campaign::delete($id);
    Redirect::to('/campaign', array('message' => 'Poistit juuri kampanjan ' . $campaign->name .' pysyvästi!'));
  }

  public static function update($id) {
    self::check_logged_in();
    $params = $_POST;
    $campaign = new Campaign(array(
      'name' => $params['name'],
      'id' => $id,
      'prosperity' => $params['prosperity']
    ));

    Kint::dump($params);

    $campaign->update();

    Redirect::to('/campaign/'.$id, array('message' => 'Muokkasit kampanjaa '  . $campaign->name .'!'));
  }

}
