<?php
   
   $page_title = 'page';
   require_once 'check.php';


   if(!isset($_SERVER['REQUEST_URI'])){
      header('Location: ../');
   }
   $link = explode( '/' , trim($_SERVER['REQUEST_URI'] , '/') );
   $id = (count($link) > 1) ? trim($link[1]) : '';

   $pages = get_all_pages();
   if($id != '' and ($page_info = get_page($id, $pages)) != false){
      $messages = get_all_messages($page_info , true);
      require_once 'page.php';
   }else{
   ?>
      <main class="section">
         <div class="container grid main-container">
            <?php 
            if(!empty($pages)){
               foreach($pages as $page){
                  // for($i=0; $i<count($pages); $i++){
                     ?>
                  <a href="<?php echo 'page/' . $page['id'] ?>" >
                     <div class="page">
                        <div class="icon">
                           <img src="images/logo.jpg">
                        </div>
                        <div class="info">
                           <h3><?php echo $page['title'] ?></h3>
                           <p><?php echo $page['discription'] ?></p>
                           <div class="about">
                              <i class="fas fa-user"></i>
                              <span><?php echo $page['members'] ?></span>
                           </div>
                        </div>
                     </div>
                  </a>
                  <?php 
               }
            }else{
               ?>
               <p>No pages yet</p>
               <?php 
            }
            ?>
         </div>
      </main>

   <?php
   }
   
?>








<?php
   require_once '../static/footer.php';
?>