<?php 

define('DATA_ROOT' , PATH . 'data/');
// echo __DIR__ . '</br>';
// echo PATH;
define('FILE_PAGES' , DATA_ROOT . 'pages.json');
define('ID_PAGE' , -1001);
define('ID' , 1001);
define('ENCRIPT' , 'sahlAltalb.net');
define('FILE_USERS' , DATA_ROOT . 'users.json');
// mkdir(FILE_USERS);

function check_username($username){
   if(!is_file(FILE_USERS)){
      return false;
   }
   if(($data = file_get_contents(FILE_USERS)) != false){
      $data = json_decode($data, true);
      foreach($data as $user){
         if($user['username'] == $username){
            return true;
         }
      }
      return false;
   }
   return false;
}
function check_login($username , $password){
   if(!is_file(FILE_USERS)){
      return false;
   }
   if(($data = file_get_contents(FILE_USERS)) != false){
      $data = json_decode($data, true);
      foreach($data as $id => $user){
         if($user['username'] == $username){
            if($user['password'] == md5($password . ENCRIPT)){
               return $id;
            }
         }
      }
      return false;
   }
   return false;
}
function login($username , $password , $name){
   if(check_username($username) == false){
      if(($data = file_get_contents(FILE_USERS)) != false){
         $data = json_decode($data, true);
      }else{
         $data = [];
      }
      $temp = null;
      $temp['name'] = htmlentities($name);
      $temp['username'] = $username;
      $temp['password'] = md5($password . ENCRIPT);
      $temp['date'] = (int)(time());
      $id = ID + count($data);
      $data[$id] = $temp;
      mkdir(DATA_ROOT , 0777 , true);
      file_put_contents(FILE_USERS , json_encode($data, true));
      return $id;
   }else{
      return false;
   }
}
function check_session($session){
   if(!isset($session)){
      return false;
   }else if(!isset($session['username']) or !isset($session['password'])){
      return false;
   }else if(isset($_COOKIE['userinfo'])){
      $info = json_decode($_COOKIE['userinfo'] , true);
      if(isset($info['username']) and isset($info['password'])){
         return check_login($info['username'] , $info['password']);
      }else{
         return false;
      }
   }else{
      return false;
   }
}
function get_session($username , $password){
   if(($id = check_login($username , $password)) != false){
      return get_data($id);
   }
}
function get_data($id){
   if(!is_file(FILE_USERS)){
      return false;
   }
   if(($data = file_get_contents(FILE_USERS)) != false){
      $data = file_get_contents(FILE_USERS);
      $data = json_decode($data, true);
      $info = $data[$id];
      $info['id'] = $id;
      return $info;
   }
}




function filter_page_data($input){
   $output = null;
   if(isset($input['title'])){
      $output['title'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['title']);
   }
   if(isset($input['discription'])){
      $output['discription'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['discription']);
   }
   if(isset($input['key-words'])){
      $output['key-words'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['key-words']);
      $output['key-words'] = explode(',' , $output['key-words']);
   }
   $output['title'] = (empty($output['title'])) ? 'new page' : $output['title'];
   return $output;
}
function create_page($title , $dis , $key_words){
   // if(!is_file(FILE_PAGES)){
   //    return false;
   // }
   if(($pages = file_get_contents(FILE_PAGES)) != false){
      $pages = json_decode($pages, true);
   }else{
      $pages = [];
   }
   $temp['title'] = $title;
   $temp['discription'] = $dis;
   $temp['key-words'] = $key_words;
   $temp['date'] = (int)(time());
   $temp['creator'] = $_SESSION['id'];
   $temp['array-members'][] = $_SESSION['id'];
   $temp['members'] = 1;
   $temp['id'] = ID_PAGE - count($pages);
   $path = DATA_ROOT . '/users/' . $temp['creator'] . '/pages/' ;
   $temp['path'] = $path . $temp['id'] . '.json';
   $pages[$temp['id']] = $temp;
   file_put_contents(FILE_PAGES , json_encode($pages)); // add to main file 'PAGES' . 
   $message[0]['type'] = 'notify';
   $message[0]['content'] = 'created';
   $message[0]['date'] = $temp['date'];
   if(!is_file($path . $temp['id'] . '.json')){
      mkdir($path , 0777 , true);
   }
   file_put_contents($path . $temp['id'] . '.json' , json_encode($message));
   return $temp['id'];
}
function get_all_pages(string $filter = 'all'){
   if($filter == 'all'){
      if(!is_file(FILE_PAGES)){
         return false;
      }
      if(($pages = file_get_contents(FILE_PAGES)) != false){
         return json_decode($pages, true);
      }else{
         return [];
      }
   }
}
function get_page($id , $all_pages = ''){
   if($all_pages == ''){
      $all_pages = get_all_pages();
   }
   foreach($all_pages as $page_id => $page){
      if($page_id == $id){
         return $page;
      }
   }
   return false;
}

function get_all_messages($page_info , bool $checked = false){
   if(isset($page_info['id']) and ( $checked or get_page($page_info['id']) != false)){
      $content_path = DATA_ROOT . '/users/' . $page_info['creator'] . '/pages/' . $page_info['id'] . '.json';
      if(is_file($content_path)){
         return json_decode(file_get_contents($content_path) , true);
      }else{
         return false;
      }
   }else{
      return false;
   }
}


function get_icon($key){
   $icons = array(
      'file' => 'fas fa-file',
      'pdf' => 'fas fa-file-pdf',
      'zip' => 'fas fa-file-zipper',
      'audio' => 'fas fa-file-audio',
      'video' => 'fas fa-file-video',
      'code' => 'fas fa-file-code',
      'word' => 'fas fa-file-word',
      'notify' => 'fas fa-slack',
      'user' => 'fas fa-user',
      'student' => 'fas fa-user-graduate',
      'reader' => 'fas fa-book-open-reader',
      'real' => 'fas fa-user-check',
      'vip' => 'fas fa-user-tag',
      'poster' => 'fas fa-user-pen',
      'admin' => 'fas fa-user-tie',
      'panned' => 'fa fa-user-slash',
      'dev' => 'fab fa-web-awesome',
      'page' => 'fas fa-newspaper',
      'super-page' => 'fas fa-bullhorn',
      'message' => 'fas fa-message',
      'link' => 'fas fa-link',
      'exam' => 'fas fa-puzzle-piece',
      'user-link' => 'fas fa-id-card',
      'page-link' => 'fas fa-window-maximize',
   );
   return isset($icons[$key]) ? $icons[$key] : 'fas fa-circle';
}




function create_post($title , $content , $page){
   $path = DATA_ROOT . '/users/' . $page['creator'] . 
         '/pages/' . $page['id'] . '.json';

   if(($messages = file_get_contents($path)) != false){
      $messages = json_decode($messages, true);
   }else{
      $messages = [];
   }
   $temp['type'] = 'message';
   $temp['title'] = $title;
   $temp['content'] = $content;
   $temp['date'] = (int)(time());
   $temp['poster_id'] = $_SESSION['id'];
   $temp['poster'] = $_SESSION['name'];
   $temp['views'] = 1;
   $temp['id'] = count($messages);
   $messages[$temp['id']] = $temp;
   file_put_contents($path , json_encode($messages));
   print_r(json_encode($messages));
   return $temp['id'];
}
function filter_post_data($input){
   $output = null;
   if(isset($input['title'])){
      $output['title'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['title']);
   }
   if(isset($input['content'])){
      $output['content'] = preg_replace('/[^a-zA-Z0-9_ ]/' , '' , $input['content']);
   }
   return $output;
}