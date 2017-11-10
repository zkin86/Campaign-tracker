<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }

    public static function kirjautuminen(){
      View::make('login.html');
    }

    public static function historia(){
      View::make('historia.html');
    }

    public static function ryhma(){
      View::make('party.html');
    }

    public static function tavarat(){
      View::make('tavarat.html');
    }

    public static function hahmo(){
      View::make('hahmo.html');
    }

    public static function kampanja(){
      View::make('campaign.html');
    }
  }
