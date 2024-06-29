<?php

   session_start();
   
   // print_r($_SERVER);
   define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
   require_once PATH . 'function.php';

   require_once PATH . 'static/header.php';
?>