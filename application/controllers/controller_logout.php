<?php
class Controller_Logout extends Controller {
    
  function __construct() {
    $this->user = new User;
    $this->user->logOut();
  }
    
}