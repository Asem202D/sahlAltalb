<?php



   require_once 'check.php';
   require_once 'function.php';

   $sudo = array('admin' , 'poster' , 'vip');

   
   $_SESSION = get_data($_SESSION['id']);
   if(!isset($_SESSION['status']) or !in_array($_SESSION['status'] , $sudo)){
      header('Location: error.php?error=2');
      exit;
   }

   if(isset($_GET['id'])){
      $page_id = $_GET['id'];
      $page_info = get_page($page_id);
      setcookie('page_id' , $page_id , time() + 3600);
      if($_SESSION['id'] != $page_info['creator']){
         header('Location: index.php');
         exit;
      }
   }
   
   if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST'){
      $info = filter_post_data($_POST);
      $page_info = get_page($_COOKIE['page_id']);
      $id = create_post($info['title'] , $info['content'] , $page_info);
      unset($_POST);
      header('Location: posts/' . $page_info['id'] . '/' . $id);
      exit;
   }else{
      // header('Location: index.php');
      // exit;
   }
?>


   <div class="page-title">
      <a href=<?php echo "profile.php?id=" . $page_info['id']?>><h2><?php echo $page_info['title']?></h2></a>
   </div>

   <main class="section">
      <div class="container contact-container center-container main-container">
         <div class="contact-box">
            <div class="title">
               add new post
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
               <div class="icon">
                  <i class="fas fa-image"></i>
               </div>
               <div class="info">
                  <input class="text-input grow" type="text" name="title" placeholder="title">
                  <!-- <input class="text-input grow" type="text" name="content" placeholder="page discrition"> -->
               </div>
               <textarea class="text-input" type="text" name="content" placeholder="content"></textarea>
               <button class="button" type="submit">Post</button>
            </form>
         </div>
      </div>
   </main>


<?php
   require_once PATH . 'static/footer.php';

?>