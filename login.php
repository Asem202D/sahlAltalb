<?php 

session_start();


$message;
$info;

// setcookie('userinfo', '' , time());
define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
require_once 'function.php';


// $temp = mkdir('files');
define('MIN_USERNAME_LETTERS' , 5);
define('MAX_USERNAME_LETTERS' , 16);
define('MIN_NAME_LETTERS' , 3);
define('MAX_NAME_LETTERS' , 20);
define('MIN_PASSWORD_LETTERS' , 8);
define('MAX_PASSWORD_LETTERS' , 16);

$errors = array(
   'name-short' => 'name is invalid , [3 - 20] letters',
   'user-empty' => 'username is empty',
   'user-short' => 'username is so short , [5 - 16] letters',
   'pass-empty' => 'password is empty',
   'pass-short' => 'password is week , [8 - 16] letters',
   'wrong-pass' => 'invalid password',
   'pass-not-conf' => 'passwords are not equals'
);


if(isset($_SESSION) and isset($_SESSION['username']) and isset($_SESSION['password'])){
   if(check_login($_SESSION['username'] , $_SESSION['password']) != false){
      header('Location: index.php');
      exit;
   }else{
      session_destroy();
   }
}

// print_r($_SERVER);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $info = filtering_input($_POST);
   unset($_POST);
   $message = 'post';
}else if($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_GET['username'])){
   $info = filtering_input($_GET);
   // $message = json_encode($_SERVER);
   unset($_GET);
}else if(isset($_COOKIE) and isset($_COOKIE['userinfo']['username']) and isset($_COOKIE['userinfo']['password'])){
   $info = $_COOKIE['userinfo'];
   if(($id = check_login($info['username'], $info['password'])) == false){
      unset($info);
      setcookie('userinfo' , '');
   }else{
      $_SESSION = get_data($id);
      header('Location: index.php');
      exit;
   }
}else{
   $message = 'Welcom';
}

// print_r($info);


if(isset($info) and isset($info['username']) and isset($info['password']) ){
   if(($id = check_login($info['username'], $info['password'])) == false){
      if(check_username($info['username'] , $info['password']) == false){
         $id = login($info['username'], $info['password'] , $info['name']);
         $_SESSION = get_data($id);
         $temp['username'] = $info['username'];
         $temp['password'] = $info['password'];
         setcookie('userinfo', json_encode($temp) , time() + (3600 * 24 * 30 * 12) , true);
         header('Location: index.php');
         exit;
      }else{
         $message = $errors['wrong-pass'];
      }
   }else{
      $_SESSION = get_data($id);
      header('Location: index.php');
      exit;
   }
}else{
   if(isset($check['error']))
      $message = $errors[$check['error']];
   else
      $message = 'Log in';
}

            // print_r($info);
            // echo '<br>';
            // echo 'aaaaaaaaaaaa';
            // echo '<br>';
            // print_r($_SESSION );

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="css/main.css">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log in </title>
</head>
<body>
   <main>
      <div class="container login-container">
         <div class="titles">
            <p class="actives">Log in</p>
            <p >sign in</p> 
            <span><?php echo $message ?></span>
         </div>
         <div class="form">
            <div class="login">
               <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                  <div class="div">
                     <input class="text-input" type="text" placeholder="name" name="name" value="<?php echo (isset($info['name'])) ?  $info['name'] : '' ?>">
                     <input class="text-input" type="text" placeholder="username" name="username" value="<?php echo (isset($info['username'])) ?  $info['username'] : '' ?>">
                  </div>
                  <div  class="div">
                     <input class="text-input" type="password" name="password" placeholder="password">
                     <input class="text-input" type="password" name="con-password" placeholder="confirm password">
                  </div>
                  <div class="agree">
                     <input type="checkbox" name="agree">
                     <span><a href="#">agree, term of uses</a></span>
                  </div>
                  <!-- <input type="submit" value="send"> -->
                  <button class="button" type="submit">Login</button>
               </form>
            </div>
            <!-- <div class="signin">
               <form action="#" method="POST">
                  <div class="div">
                     <input class="text-input" type="text" placeholder="username" name="username">
                     <input class="text-input" type="password" name="password" placeholder="password">
                  </div>
                  <button class="button" type="submit">Sign in</button>
               </form>
            </div> -->
         </div>
      </div>
   </main>
</body>
</html>

<?php

function check_input($input){
   $output = null;
   if(!isset($input)){
      $output['error'] = '';
   }else 
   if(!isset($input['username'])){
      $output['error'] = 'user-empty';
   }else 
   if(strlen($input['username']) < MIN_USERNAME_LETTERS or strlen($input['username']) > MAX_USERNAME_LETTERS ){
      $output['error'] = 'user-short';
   }else
   if(!isset($input['password'])){
      $output['error'] = 'pass-empty';
   }else 
   if(strlen($input['password']) < MIN_PASSWORD_LETTERS or strlen($input['password']) > MAX_PASSWORD_LETTERS){
      $output['error'] = 'pass-short';
   }else 
   if(!isset($input['name']) or empty($input['name'])){
      return null;
   }else 
   if(strlen($input['name']) < MIN_NAME_LETTERS or strlen($input['name']) > MAX_NAME_LETTERS){
      $output['error'] = 'name-short';
   }else 
   if($input['password'] != $input['con-password']){
      $output['error'] = 'pass-not-conf';
   }
   return $output;
}




function filtering_input($input){
   $output = null;
   if(isset($input['name'])){
      $output['name'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['name']);
   }
   if(isset($input['password'])){
      $output['password'] = $input['password'];
   }
   if(isset($input['con-password'])){
      $output['con-password'] = $input['con-password'];
   }
   if(isset($input['status'])){
      $output['status'] = $input['status'];
   }
   if(isset($input['username'])){
      $output['username'] = preg_replace('/[^a-zA-Z0-9_]/' , '' , $input['username']);
   }
   return $output;
}
