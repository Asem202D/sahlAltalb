<?php
   require_once 'check.php';
?>



   <main class="section">
      <div class="container contact-container center-container main-container">
         <div class="contact-box">
            <div class="title">
               contact us
            </div>
            <form action="#">
               <div class="info">
                  <input class="text-input grow" type="text" name="name" placeholder="name">
                  <input class="text-input grow" type="text" name="title" placeholder="message title">
               </div>
               <textarea class="text-input" type="text" name="message" placeholder="message"></textarea>
               <button class="button" type="submit">send</button>
            </form>
         </div>
      </div>
   </main>


<?php
   require_once PATH . 'static/footer.php';
?>