<?php
require 'app/models/party.php';
require 'app/models/campaign.php';
class PartyController extends BaseController{

  public static function info($cid, $id){
    $party = Party::find($id);
    $parties = Party::all_for_Campaign($cid);
    $campaign = Campaign::find($cid);
    View::make('party/party.html', array('attributes' => $campaign, 'party' => $party, 'parties' => $parties));
  }
}