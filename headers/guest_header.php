<?php
if(!defined('ILAW')){
    header('location: ../index.php');
    die();
  }
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<header class="ilaw_header">
        <a class = "logo_header"><img src="images/Logo/ILAW_Logo.png" alt="ILAW Logo" onclick="window.location='index.php';" ></a>
        <a class="toggle-menu" onclick="toggleSidebar()"><i class="fas fa-bars fa-2x"></i></a>
        <ul id ="menuList" >
            <!-- Home Page -->
            <?php 
                    if($active == "Homepage"){
                    ?>
                    <li>
                         <a class="active" href="index.php">HOME</a>  
                    </li>
                    <?php }else{ ?>
                    <li>
                         <a href="index.php">HOME</a>   
                    </li>
                <?php  } ?>
                <!-- Product Page -->
            <?php 
                    if($active == "Product"){
                    ?>
                    <li>
                        <a class="active" href="product.php#products">PRODUCT</a> 
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="product.php#products">PRODUCT</a> 
                    </li>
                <?php  } ?>
            <?php 
                    if($active == "Reviews"){
                    ?>
                    <li>
                        <a class="active" href="reviews.php#reviews">REVIEWS</a> 
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="reviews.php#reviews">REVIEWS</a>
                    </li>
                <?php  } ?>  
            <?php 
                    if($active == "Team"){
                    ?>
                    <li>
                        <a class="active" href="team.php#team">TEAM</a> 
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="team.php#team">TEAM</a>
                    </li>
                <?php  } ?> 
                <?php 
                    if($active == "About"){
                    ?>
                    <li>
                        <a class="active" href="about.php#about">ABOUT</a> 
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="about.php#about">ABOUT</a>
                    </li>
                <?php  } ?>          
            <button class = "orderstat_btn" onclick="showAlert()" type="button">Order Status</button>

            <div class="dropdown">
                <a style="color: #F7941D" onmouseover='this.style.color="grey"'onmouseout='this.style.color="#F7941D"' class = "cart_btn"><i class="fas fa-shopping-cart fa-2x"></i><span class="badge"></span></a>
                <div class="dropdown-content">
                    <div class="cart_product" id="cart_product">
                    <!-- Product Added -->
                    
                    </div>
                
                <a class="panel-footer2 text-center" href="cart.php#cart">View Shopping Cart</a>
                </div>
            </div>  
            </div>        
            <button class = "login_btn" type="button" onclick="window.location='login.php';" >
                <span class="login_text text-white"> Login </span>
                <span class="login_icon text-white"><i class="fas fa-sign-in-alt"></i></span>
            </button>
        </ul>
    </header>
    <script>
        function showAlert() {
            //alert ("Saved Successfully!");  
            swal({
            title: "Order Status requires Account",
            text: 'You will be redirect to login form click "ok" to proceed',
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willLogin) => {
            if (willLogin) {
                window.location.href = "login.php";;
            }
        });
        }
    </script>