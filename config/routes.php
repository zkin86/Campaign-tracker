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


  //$routes->get('/campaign/new', function(){
  //CampaignController::create();
  //});

  //$routes->get('/campaign/:id', function($id){
  //CampaignController::show($id);
  //});
