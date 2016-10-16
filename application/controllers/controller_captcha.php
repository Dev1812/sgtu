<?php

class Controller_Captcha extends Controller {
    
  function __construct() {
    $captcha = new Captcha;
    $captcha->generate();
  }


}