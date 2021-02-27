<!DOCTYPE html>
<?php
    include('functions/session.php');
    include('functions/products_functions.php');
    include('functions/register_functions.php');
    include('functions/login_functions.php');
    include('functions/cart_functions.php');
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
                    <li><a href="customer/my_account.php">My account</a></li>
                    <li><a href="cart.php">Shopping cart</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="customer_login.php">Sign up</a></li>
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
                
                <div class="login">
                    <form action="customer_register.php" method="post">

                        <table text-align="center" width="500" align="center">

                            <tr>
                                <td colspan="2"><h2>Create an account</h2></td>
                            </tr>

                            <tr>
                                <td align="right">Name:</td>
                                <td align="left"><input type="text" class="textBox" name="c_name" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Surname:</td>
                                <td align="left"><input type="text" class="textBox" name="c_surname" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Email:</td>
                                <td align="left"><input type="emial" class="textBox" name="c_email" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Password:</td>
                                <td align="left"><input type="password" class="textBox" name="c_password" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Phone number:</td>
                                <td align="left"><input type="text" class="textBox" name="c_phone_number" required/></td>
                            </tr>

                            <tr>
                                <td align="right">City:</td>
                                <td align="left"><input type="text" class="textBox" name="c_city" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Postal code:</td>
                                <td align="left"><input type="text" class="textBox" name="c_postal_code" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Street:</td>
                                <td align="left"><input type="text" class="textBox" name="c_street" required/></td>
                            </tr>

                            <tr>
                                <td align="right">Home number:</td>
                                <td align="left"><input type="text" class="textBox" name="c_home" required/></td>
                            </tr>

                            <tr>
                                <td colspan="2"><input type="submit" class="button" name="register" value="Create Account" style="font-size:1vw; margin: 20px;"/></td>
                            </tr>

                        </table>


                    </from>
                </div>

            </div>
        </div>
        <!--End of contenr wrapper-->

        <div id="footer">
            
            <h2 style="text-align:center;">&copy; 2020 by Adam Mąkiewicz</h2>

        </div>

    </div>
    <!--End of main container-->


<script src="js/AlertBox.js"></script>
</body>
</html>

<?php
    addNewUser();
?>