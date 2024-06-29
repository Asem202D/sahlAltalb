<!DOCTYPE html>
<html lang="en">
<head>
<?php 
   if(count(explode('/' , PATH)) > 1 ){
      $root = str_repeat('../' , count(explode('/' , PATH)));
   }else{
      $root = '';
   }
   ?>
   <meta charset="UTF-8">
   <link rel="stylesheet" href= <?php echo $root . "fontawsom/css/all.min.css"?>  >
   <link rel="stylesheet" href= <?php echo $root . "css/main.css"?>  >
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sahl Altalb</title>
</head>
<body>
   <header>
      <div class="container">
         <a href=<?php echo $root . "../profile.php?id=" . $_SESSION['id']?>>
            <div class="profile">
               <div class="image">
                  <?php 
                  if(isset($_SESSION['image'])){
                     echo '<img src="images/logo.jpg" alt="your logo">';
                  }else{
                  echo '<i class="'. get_icon((isset($_SESSION['status'])) ? $_SESSION['status'] : 'user') . ' fa-2x"></i>';
                  }
                  ?>
               </div>
               <div class="dis">
               <h4><?php echo $_SESSION['name'] ?></h4>
                  <p><?php echo (isset($_SESSION['status'])) ? $_SESSION['status'] : 'user' ?></p>
               </div>
            </div>
         </a>
         <div class="logo">
            <span>Sahl Altalb</span>
         </div>
         <div class="menu">
            <i class="fas fa-list"></i>
            <ul>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../index.php"?> >Home</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/post.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../post.php"?> >Favorite</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/page.php' || (isset($page_title) and $page_title == 'page') ) ? 'class="active"' : ''; ?> href=<?php echo $root . "../page"?> >Pages</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/add_page.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../add_page.php"?> >add page</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/privacypolicy.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../privacypolicy.php"?> >Privacy Policy</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/contact.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../contact.php"?> >Contact us</a></li>
               <li><a <?php echo ($_SERVER['PHP_SELF'] == '/about.php') ? 'class="active"' : ''; ?> href=<?php echo $root . "../about.php"?> >About</a></li>
            </ul>
         </div>
      </div>
   </header>