<?php
require 'app/models/campaign.php';
class CampaignController extends BaseController{
  public static function index(){
    $campaigns = Campaign::all();
    View::make('campaign/index.html', array('campaigns' => $campaigns));
  }

  public static function store(){

	$params = $_POST;
    $campaign = new Campaign(array(
      'name' => $params['name'],
      'omistaja_id' => $params['omistaja_id']
    ));

    Kint::dump($params);

    $campaign->save();

    //Redirect::to('/campaign/' . $campaign->id, array('message' => 'Kampanja on lisätty!'));
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Campaign(name, omistaja_id) VALUES (:name, :omistaja_id');
    $query->execute(array('name' => $this->name, 'omistaja_id' => $this->omistaja_id));
    $row = $query->fetch();
    Kint::trace();
    Kint::dump($row);
    
    //$this->id = $row['id'];
  }

  public static function new(){
  	View::make('campaign/new.html');
  }
}