<?php
  session_name('sid');
  session_start();
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');
  require_once SITE_ROOT.'application/bootstrap.php';	
?>