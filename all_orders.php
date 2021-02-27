<!DOCTYPE html>
<?php
    include('functions/session.php');
    include('functions/products_functions.php');
    include('functions/login_functions.php');
    include('functions/cart_functions.php');
    include('functions/manage_orders.php');
    acceptOrder();
    cancelOrder();
    changeSort();
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Shop</title>

    <link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body>


    <!--Main container-->
    <div class="main_wrapper">

        <!--Header-->
        <div class="header_wrapper">
            <img id="logo" src = "images/logo.jpg" alt="Logo"/>

            <!--Navbar-->
            <div class="menubar">
                
            <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="customer_login.php">Sign up</a></li>
                    <li><a href="cart.php">Shopping cart</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><?php
                            if(isset($_SESSION['customer_email']))
                            {
                                if($_SESSION['is_admin'] == 1)
                                {
                                    echo "<a href='all_orders.php'>Manage orders</a>";
                                }
                                else
                                {
                                    echo "<a href='all_orders.php'>My orders</a>";
                                }
                            }
                        ?></li>
                </ul>

                <div id="form">
                    <form method="get" action="search_results.php" enctype="multipart/form-data">
                        <input type="text" class="textBox" name="user_query" placeholder="Search a Product"/>
                        <input type="submit" class="button2" name="search" value="Search" />
                    </form>
                </div>

            </div>
            <!--End of navbar-->
        </div>
        <!--End of header-->

        <!--Content wrapper-->
        <div class="content_wrapper">

            <div id="sidebar">

                <div class="sidebar_title">Categories</div>

                <ul id="cats">
                
                    <?php
                        getCats();
                    ?>

                </ul>


                <div class="sidebar_title">Brands</div>

                <ul id="cats">

                    <?php
                        getBrands();
                    ?>

                </ul>

            </div>

            <div id="content_area">
                
                <div id="shopping_bar">
                    
                    <span style="float:left; font-size: 0.9vw; padding: 0.3vw; line-height: 2vw;">
                    Welcome
                        <?php
                            if(isset($_SESSION['customer_email']))
                            {
                                if($_SESSION['is_admin'] == 1)
                                    echo "admin ";
                                else
                                    echo "customer ";
                                echo $_SESSION['customer_email'];
                                echo " !";
                            }
                            else
                                echo " Guest !";
                        ?>
                        Items in cart: <?php if(isset($_SESSION['Total_items']))
                                                echo $_SESSION['Total_items'];
                                            else
                                                echo 0
                        ?>
                    </span>
                    <span style="float:right; font-size: 1vw; padding: 0.3vw; line-height: 2vw;">
                        <?php
                            if(isset($_SESSION['customer_email']))
                            {
                                if($_SESSION['is_admin'] == 1)
                                {
                                    if($_SESSION['sort_by'] == 1)
                                        echo "<a href='?changeSort' onclick='changeSort()'>Sort by awaiting delivery</a>";
                                    if($_SESSION['sort_by'] == 2)
                                        echo "<a href='?changeSort' onclick='changeSort()'>Sort by awaiting accept</a>";
                                }
                            }
                        ?>
                        <div class="dropdown">
                            <button class="dropbtn">Menu</button>
                            <div class="dropdown-content">
                                <?php
                                    checkUserLogged();
                                ?>
                            </div>
                        </div>
                    </span>
                
                </div>

                
                <div class="allOrders">
                    <h3 align="center" style='font-size: 1.5vw;'><?php displayTitle();?></h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="80%" class="OrdersTable">
                            <tr style='font-size: 1.1vw;'>
                            <?php
                                if($_SESSION['is_admin'] == 1)
                                {
                                    echo "
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Payment ID</th>
                                    <th>Is paid</th>
                                    <th>Details</th>
                                    <th>Accept</th>
                                    <th>Cancel</th>
                                    ";
                                    displayAllOrders();
                                }
                                else
                                {
                                    echo "
                                    <th>Order ID</th>
                                    <th>Payment ID</th>
                                    <th>Total cost</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    ";
                                    displayUserOrders();
                                }
                            ?>
                            </tr>
                        </table> 
                    </form>
                </div>

            </div>
        </div>
        <!--End of contenr wrapper-->

        <div id="footer">
            
            <h2 style="text-align:center;">&copy; 2020 by Adam Mąkiewicz</h2>

        </div>

    </div>
    <!--End of main container-->



</body>
</html>

<?php
    loginUser();
?>