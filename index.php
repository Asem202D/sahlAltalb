<?php
   require_once 'check.php';

   $pages = get_all_pages();
?>


   <main class="section">
      <div class="container grid main-container">
         <?php 
         if(!empty($pages)){
            foreach($pages as $page){
                  ?>
               <a href="<?php echo 'add_post.php?id=' . $page['id'] ?>">
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
   require_once PATH . 'static/footer.php';
?>