<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
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

  $routes->get('/login', function(){
    UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->get('/exit', function() {
    UserController::logout();
  });

  $routes->get('/campaign/:id/edit', function($id){

  CampaignController::edit($id);
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


  //$routes->get('/campaign/new', function(){
  //CampaignController::create();
  //});

  //$routes->get('/campaign/:id', function($id){
  //CampaignController::show($id);
  //});
