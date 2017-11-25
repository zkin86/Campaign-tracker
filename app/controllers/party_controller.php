<?php
require 'app/models/party.php';
class PartyController extends baseController{

  public static function info($id){
    $party = Party::find($id);
    View::make('party/party.html', array('attributes' => $party));
  }
}