<?php
   session_start();
   
   define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
   require_once PATH . 'function.php';

   if(check_session($_SESSION) === false){
      header('Location: login.php');
      exit;
   }

   require_once PATH . 'static/header.php';
?>