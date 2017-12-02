<?php

  $routes->get('/', function() {
    BaseController::home();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/ryhma', function() {
    HelloWorldController::ryhma();
  });

  $routes->get('/historia', function() {
    HelloWorldController::historia();
  });

  $routes->get('/tavarat', function() {
    HelloWorldController::tavarat();
  });

  $routes->get('/kampanja', function() {
    HelloWorldController::kampanja();
  });

  $routes->get('/campaign', function() {
  	CampaignController::index();
  });

  $routes->get('/hahmo', function() {
    HelloWorldController::hahmo();
  });

  $routes->post('/campaign', function(){
    CampaignController::store();
  });

  $routes->get('/campaign/new', function(){
    CampaignController::new();
  });

  $routes->get('/kirjautuminen', function(){
    UserController::login();
  });

  $routes->post('/kirjautuminen', function(){
    UserController::handle_login();
  });

  $routes->get('/exit', function() {
    UserController::logout();
  });

  $routes->get('/campaign/:id/edit', function($id){
    CampaignController::edit($id);
  });

  $routes->get('/campaign/:id/new', function($id){
    PartyController::new($id);
  });

  $routes->get('/campaign/:cid/:id', function($cid, $id){
    PartyController::info($cid, $id);
  });

  $routes->get('/campaign/:id', function($id){
    CampaignController::info($id);
  });
  
  $routes->post('/campaign/:id/edit', function($id){
    CampaignController::update($id);
  });

  $routes->post('/campaign/:id/destroy', function($id){
    CampaignController::destroy($id);
  });

  $routes->get('/campaign/:cid/:pid/:id', function($cid, $pid, $id){
    CharacterController::info($cid, $pid, $id);
  });

  $routes->post('/campaign/:id', function($id){
    PartyController::store($id);
  });

  $routes->get('/uusi', function(){
    UserController::new();
  });

  $routes->post('/uusi', function(){
    UserController::store();
  });




  //$routes->get('/campaign/new', function(){
  //CampaignController::create();
  //});

  //$routes->get('/campaign/:id', function($id){
  //CampaignController::show($id);
  //});
