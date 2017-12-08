<?php

  $routes->get('/', function() {
    BaseController::home();
  });

//  $routes->get('/hiekkalaatikko', function() {
//    HelloWorldController::sandbox();
//  });

//  $routes->get('/ryhma', function() {
//    HelloWorldController::ryhma();
//  });

//  $routes->get('/historia', function() {
//    HelloWorldController::historia();
//  });

//  $routes->get('/tavarat', function() {
//    HelloWorldController::tavarat();
//  });

 // $routes->get('/kampanja', function() {
 //   HelloWorldController::kampanja();
 // });

  $routes->get('/campaign', function() {
    CampaignController::index();
  });

//  $routes->get('/hahmo', function() {
//    HelloWorldController::hahmo();
//  });

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

  $routes->get('/campaign/:cid/edit', function($cid){
    CampaignController::edit($cid);
  });

  $routes->get('/campaign/:cid/new', function($cid){
    PartyController::new($cid);
  });

  $routes->get('/campaign/:cid/:pid', function($cid, $pid){
    PartyController::info($cid, $pid);
  });

  $routes->get('/campaign/:id', function($cid){
    CampaignController::info($cid);
  });

  $routes->post('/campaign/:id/edit', function($id){
    CampaignController::update($id);
  });

  $routes->post('/campaign/:id/destroy', function($id){
    CampaignController::destroy($id);
  });

  $routes->get('/campaign/:cid/:pid/edit', function($cid, $pid){
    PartyController::edit($cid, $pid);
  });

  $routes->get('/campaign/:cid/:pid/new', function($cid, $pid){
    CharacterController::new($cid, $pid);
  });

  $routes->get('/campaign/:cid/:pid/:id', function($cid, $pid, $id){
    CharacterController::info($cid, $pid, $id);
  });

  $routes->post('/campaign/:id', function($cid){
    PartyController::store($cid);
  });

  $routes->post('/campaign/:cid/:pid', function($cid, $pid){
    CharacterController::store($cid, $pid);
  });

  $routes->get('/uusi', function(){
    UserController::new();
  });

  $routes->post('/uusi', function(){
    UserController::store();
  });

  $routes->get('/user/', function(){
    UserController::info();
  });

  $routes->get('/campaign/:cid/:pid/:chid/edit', function($cid, $pid, $chid){
    CharacterController::edit($cid, $pid, $chid);
  });

  $routes->post('/campaign/:cid/:pid/:chid', function($cid, $pid, $chid){
    CharacterController::store($cid, $pid, $chid);
  });




  //$routes->get('/campaign/new', function(){
  //CampaignController::create();
  //});

  //$routes->get('/campaign/:id', function($id){
  //CampaignController::show($id);
  //});
