<?php
   require_once 'check.php';

   if($_GET['id']){
      if($_GET['id'] >= ID){
         $data = get_data($_GET['id']);
      }else if ($_GET['id'] <= ID_PAGE){
         $data = get_page($_GET['id']);
         $data['name'] = $data['title'];
         $data['username'] = $data['id'];
         $data['bio'] = $data['discription'];
         $data['status'] = 'super-page';
      }else{
         header('Location: index.php');
         exit;
      }
   }
?>

   <div class="hr"></div>
   <main class="section">
      <div class="container main-container">
         <div class="card">
            <div class="head">
               <div class="img">
                  <i class="<?php echo get_icon((isset($data['status'])) ? $data['status'] : 'user') ?>"></i>
               </div>
               <div class="info">
                  <div class="dis">
                     <h3><?php echo $data['name'] ?></h3>
                     <p><?php echo (isset($data['bio']))?$data['bio'] : 'user in sahl altalb' ?></p>
                  </div>
               </div>
            </div>
            <div class="more">
               <p><i class="fa-solid fa-at"></i><span><?php echo $data['username'] ?></span></p>
               <span id="status"><?php echo (isset($data['status']))?$data['status'] : 'user' ?></span>
               <?php
                if(isset($data['list'])){
                  foreach($data['list'] as $item){
                     echo '<div><i class="fas fa-' . $item['icon'] . '"></i>' . $item['title'] . '</div>';
                  }
                }
               
               ?>
               
            </div>
            <div class="buttons">
            </div>
         </div>
      </div>
   </main>




<?php
   require_once PATH . 'static/footer.php';
?>