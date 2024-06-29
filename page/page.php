<?php
   require_once 'check.php';
?>


   <div class="page-title">
      <a href=<?php echo "../profile.php?id=" . $page_info['id']?>><h2><?php echo $page_info['title']?></h2></a>
   </div>

   <main class="section">
      <div class="container grid main-container">

      <?php
         if(isset($messages)){
            foreach($messages as $message){
               if($message['type'] == 'notify'){
                  ?>

                  <div class="notify">
                     <i class="fab fa-slack"></i>
                     <span><?php echo $message['content'] ?></span>
                  </div>

               <?php
               }else if($message['type'] == 'message'){
                  ?>

                  <div class="post">
                     <div class="icon">
                     </div>
                     <div class="info">
                        <div class="title">
                           <h3><?php echo $message['title'] ?></h3>
                           <div class="type">
                           <i class="<?php echo get_icon($message['type']) ?>"></i>
                           <?php echo $message['type'] ?>
                           </div>
                        </div>
                        <p><?php echo $message['content'] ?></p>
                        <div class="attributs">
                           <span><i class="fas fa-eye"></i><?php echo $message['views'] ?></span>
                           <span><i class="fas fa-pen"></i><?php echo $message['poster'] ?></span>
                           <a href="<?php echo '../posts/' . $page_info['id'] . '/' . $message['id'] ?>"><span><i class="fas fa-quote-right"></i>Read</span></a>
                        </div>
                     </div>
                  </div>

               <?php
               }
            }
         }
      ?>

         <!-- <div class="post" id="#">
            <div class="icon">
            </div>
            <div class="info">
               <div class="title">
                  <h3>post title</h3>
                  <div class="type">
                     <i class="fas fa-file"></i>
                     PDF 
                  </div>
               </div>
               <p>post short descrition or short cut from content of the post Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea autem iure repudiandae recusandae alias rem ullam ratione laudantium eligendi commodi!</p>
               <div class="attributs">
                  <span><i class="fas fa-eye"></i>3k</span>
                  <span><i class="fas fa-pen-nib"></i>Asem Najee</span>
                  <a class="f"href="post.php"><span><i class="fas fa-quote-right"></i>read more</span></a>
               </div>
            </div>
         </div> -->
         <!-- <div class="post file">
            <div class="icon">
            </div>
            <div class="info">
               <div class="title">
                  <h3>post title</h3>
                  <div class="type">
                     <i class="fas fa-file-pdf"></i>
                     PDF 
                  </div>
               </div>
               <p>post short descrition or short cut from content of the post Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea autem iure repudiandae recusandae alias rem ullam ratione laudantium eligendi commodi!</p>
               <div class="attributs">
                  <span><i class="fas fa-pen"></i>3k</span>
                  <span><i class="fas fa-pen"></i>Asem Najee</span>
                  <a class="f"href="post.php"><span><i class="fas fa-download"></i>Download</span></a>
               </div>
            </div>
         </div> -->
         
      </div>
   </main>

<?php
   require_once PATH . 'static/footer.php';
?>