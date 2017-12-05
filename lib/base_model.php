<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function validate_string_length($string, $length){
      if(strlen($string) >= $length) {
        return TRUE;
      }
      return FALSE;
    }

    public function validate_string($string) {
      if($string != '' && $string != null) {
        return FALSE;
      }
      return TRUE;
    }

    public function validate_integer($integer){
      if(intval($integer)===$integer) {
        return TRUE;
      }
      return FALSE;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }

      return $errors;
    }

  }
