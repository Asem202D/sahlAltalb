<?php



   require_once 'check.php';
   require_once 'function.php';

   $sudo = array('admin' , 'poster' , 'vip');


   $_SESSION = get_data($_SESSION['id']);
   if(!isset($_SESSION['status']) or !in_array($_SESSION['status'] , $sudo)){
      header('Location: error.php?error=1');
      exit;
   }

   if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD'] == 'POST'){
      $info = filter_page_data($_POST);
      // print_r($_POST);
      // print_r($info);
      $id = create_page($info['title'] , $info['discription'] , $info['key-words']);
      unset($_POST);
      header('Location: page/' . $id);
   }
?>



   <main class="section">
      <div class="container contact-container center-container main-container">
         <div class="contact-box">
            <div class="title">
               add new page
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
               <div class="icon">
                  <i class="fas fa-image"></i>
               </div>
               <div class="info">
                  <input class="text-input grow" type="text" name="title" placeholder="title">
                  <input class="text-input grow" type="text" name="discription" placeholder="page discrition">
               </div>
               <textarea class="text-input" type="text" name="key-words" placeholder="key words"></textarea>
               <button class="button" type="submit">Create</button>
            </form>
         </div>
      </div>
   </main>


<?php
   require_once PATH . 'static/footer.php';

?>