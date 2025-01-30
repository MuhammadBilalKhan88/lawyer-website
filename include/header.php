<header>


    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center justify-content-between no-gutters">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.php">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-8">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a class="active" href="index.php">home</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="Practice.php">Practice Area</a></li>
                                    <li><a href="our_lawyers.php">Lawyers Directory</a></li>
                             
                                        <!-- <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.php">elements</a></li>
                                            </ul>
                                        </li> -->
                                    <li><a href="contact.php">Contact</a></li>
                                    <!-- <a href="#" class="boxed-btn4 " style="    padding: 9px 40px;">Signup as Lawyer</a> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-2 d-none d-lg-block">

                        <div class="d-flex " style="align-items: center;    gap: 8px; ">

                            <?php
                            session_start();
                            if (!isset($_SESSION['loggedin'])  ||  $_SESSION['loggedin'] !== true) {
                                echo '<a href="sign-up-lawyer.php" class="boxed-btn4 mx-2" style="    padding: 9px 40px;">Signup</a>';
                                echo '<a href="sign-up-lawyer.php" class="boxed-btn4 " style="    padding: 9px 40px;">Login</a>';
                            } else{

                                if($_SESSION['user_type']==='lawyer'){
                                       $dashboard_link = "lawyer-dashboard.php"; 
                                }elseif($_SESSION['user_type']==='Admin'){
                                    $dashboard_link = "adminpanel/index.php"; 
                                }else{
                                    $dashboard_link = "#";
                                }
                                //$lawyer_dahboardlink  = ($_SESSION['user_type']==='lawyer' OR 'ADM' ) ? 'lawyer-dashboard.php' : '#';
                                
                                echo '
                                <ul>
                                    <li><a href="'.  $dashboard_link  .'" class="mx-2"> <i class="fa fa-user" style="color:#fff;"></i></a></li>
                                </ul> ';
                                echo  "<a class='text-white'>" . htmlspecialchars($_SESSION['user_name']) . "<a/>";
                                echo '<a href="logout.php" class="boxed-btn4 " style="    padding: 9px 40px;">Login Out</a>';
                            }
                            

                            ?>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>