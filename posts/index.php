<?php
   
   $page_title = 'page';
   require_once 'check.php';


   if(!isset($_SERVER['REQUEST_URI'])){
      header('Location: ../');
   }
   $link = explode( '/' , trim($_SERVER['REQUEST_URI'] , '/') );

   if(count($link) != 3){
      header('Location: ../page'.((count($link) > 1) ? '/' . $link[1] : ''));
      exit;
   }

   $id = trim($link[1]);
   $message_id = trim($link[2]);

   $page_info = get_page($id);
   ?>

   <div class="page-title">
      <a href=<?php echo "profile.php?id=" . $page_info['id']?>><h2><?php echo $page_info['title']?></h2></a>
   </div>

   <?php
   if(($page_info = get_page($id)) != false){
      $messages = get_all_messages($page_info , true);
      if(count($messages) > -$message_id ){
         $message = isset($messages[$message_id]) ? $messages[$message_id] : array('type'=> 'error' , 'title'=> 'error' , 'content'=> 'message not found');
      ?>

      <main class="section">
         <div class="container main-container">
            <div class="message">
               <div class="title">
                  <i class="<?php echo get_icon($message['type'])?>"></i>
                  <!-- <i class="fas fa-file fa-3x"></i> -->
                  <h2 class="title"><?php echo $message['title']?></h2>
               </div>
               <p><?php echo $message['content']?></p>
               <div class="share button-list">
                  <div class="item">
                     <i class="fas fa-share"></i>
                     <span>share</span>
                  </div>
                  <div class="item">
                     <i class="fa-solid fa-thumbs-down"></i>
                     <span>dis like</span>
                  </div>
                  <div class="item">
                     <i class="fas fa-thumbs-up"></i>
                     <span>like</span>
                  </div>
                  <div class="item">
                     <i class="fas fa-heart"></i>
                     <span>favorite</span>
                  </div>
                  <div class="item">
                     <i class="fas fa-download"></i>
                     <span>download</span>
                  </div>
               </div>
            </div>
         </div>
         
      </main>

      <?php
      }else{  
         header('Location: ../page/'. $id);
         exit;
      }
   }else{
   }
   
?>








<?php
   require_once '../static/footer.php';
?>