<?php 
  // Load Config
  require_once 'config/config.php';

  //Load Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';

  // Mail Sender
  require_once 'mailer/class.phpmailer.php'; 

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php'; 
  });