<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</header>
<header class="header">
  <nav class="navbar navbar-expand-lg">
    <div class="search-panel">
      <div class="search-inner d-flex align-items-center justify-content-center">
        <div class="close-btn">Close <i class="fa fa-close"></i></div>
        <form id="searchForm" action="#">
          <div class="form-group">
            <input type="search" name="search" placeholder="What are you searching for...">
            <button type="submit" class="submit">Search</button>
          </div>
        </form>
      </div>
    </div>
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header--><a href="index.php" class="navbar-brand">
          <div class="brand-text brand-big visible text-uppercase"><strong
              class="text-primary">Lawyer</strong><strong></strong></div>
          <div class="brand-text brand-sm"><strong class="text-primary">L</strong><strong></strong></div>
        </a>
        <!-- Sidebar Toggle Btn-->
        <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
      </div>
      <div class="right-menu list-inline no-margin-bottom">

      </div>


      <!-- Languages dropdown    -->

      <!-- Log out               -->


      <?php

      if (isset($_GET['usereamil'])) {
        $username = htmlspecialchars($_GET['usereamil']);

        echo '
  
                
        <div class="d-flex justify-content-center align-items-center logout"> 
          
          <a href="#">' . $username . '</a>
          <a href="#"><i class="fa fa-user mx-2" class="nav-link"></i></a>
        <a id="logout" href="../logout.php" class="nav-link">Logout <i
  class="icon-logout"></i></a></div>
    
    ';
   
      } else {


        if (!isset($_SESSION['loggedin'])   || $_SESSION['loggedin'] !== true) {
          echo '
                    
                        <div class="list-inline-item login"> <a id="login" href="index.php" class="nav-link">login <i
                         class="icon-login"></i></a></div>
                    
                    ';
        } else {
          echo '
  
                
                    <div class="d-flex justify-content-center align-items-center logout"> 
                      <a href="#">' . $_SESSION['user_email'] . '</a>
                      <a href="#"><i class="fa fa-user mx-2" class="nav-link"></i></a>
                    <a id="logout" href="logout.php" class="nav-link">Logout <i
              class="icon-logout"></i></a></div>
                
                ';
        }
      }




      ?>
    </div>
    </div>
  </nav>
</header>