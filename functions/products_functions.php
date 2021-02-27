<?php

//$con = mysqli_connect("localhost", "root", "", "ITShop");

$servername = "localhost";
$username = "root";
$password = "";

try
{
    $con = new PDO("mysql:host=$servername;dbname=ITShop", $username, $password);
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) 
{
    echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
}

//Getting categories from DB

function getCats()
{
    try
    {
        global $con;

        $get_cats = "select * from Categories";

        $row_cats = $con->query($get_cats);

        foreach($row_cats as $row)
        {
            $cat_id = $row['ID_Category'];
            $cat_name = $row['Category_Name'];

            echo "<li><a href='index.php?cat=$cat_id'>$cat_name</a></li>";
        }
        $row_cats -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

//Getting brands from DB

function getBrands()
{
    try
    {
        global $con;

        $get_brands = "select * from Brands order by RAND() LIMIT 0,9";

        $row_brands = $con->query($get_brands);

        foreach($row_brands as $row)
        {
            $brand_id = $row['ID_Brand'];
            $brand_name = $row['Brand_Name'];

            echo "<li><a href='index.php?brand=$brand_id'>$brand_name</a></li>";
        }
        $row_brands -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
} 

function getProducts($get_products)
{
    try
    {
        global $con;
        //$get_products = "select * from Products order by RAND() LIMIT 0,6";

        $run = $con->query($get_products);

        foreach($run as $row)
        {
            $pro_id = $row['ID_Product'];
            $pro_category = $row['ID_Category'];
            $pro_brand = $row['ID_Brand'];
            $pro_name = $row['Name'];
            $pro_price = $row['Price'];
            $pro_quantity = $row['Availability'];
            $pro_desc = $row['Description'];
            $pro_image = $row['Image'];
            $pro_keywords = $row['Keywords'];

            echo "
            
                    <div id='single_product'>

                        <h3>$pro_name</h3>
                        <img src='admin_area/product_images/$pro_image' width='180' height='180' />
                        <p><b>Price: $ $pro_price</b></p>
                        <a href='details.php?pro_id=$pro_id' style='float:left; text-decoration: none; color: black;'}>More details</a>
                        <input type='button' class='button' name='add_cart' value='Add to cart' onClick=\"location.href='index.php?add_cart=$pro_id'\"></input>
                    </div>

            ";
        }
        $run -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function getProductsFromCategory()
{
    try
    {
        if(isset($_GET['cat']))
        {
            $cat_id = $_GET['cat'];
            $get_products = "select * from Products where ID_Category='$cat_id'";
            getProducts($get_products);
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function getProductsByBrand()
{
    try
    {
        if(isset($_GET['brand']))
        {
            $brand_id = $_GET['brand'];
            $get_products = "select * from Products where ID_Brand='$brand_id'";
            getProducts($get_products);
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function getProductsRandom()
{
    try
    {
        if(!isset($_GET['cat']))
        {
            if(!isset($_GET['brand']))
            {
                $get_products = "select * from Products order by RAND() LIMIT 0,9";
                getProducts($get_products);
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function getProductInfo($pro_id)
{
    try
    {
        global $con;

        $get_products = "select * from Products where ID_Product='$pro_id'";

        $run = $con->query($get_products);

        foreach($run as $row)
        {
            $pro_id = $row['ID_Product'];
            $pro_category = $row['ID_Category'];
            $pro_brand = $row['ID_Brand'];
            $pro_name = $row['Name'];
            $pro_price = $row['Price'];
            $pro_quantity = $row['Availability'];
            $pro_desc = $row['Description'];
            $pro_image = $row['Image'];
            $pro_keywords = $row['Keywords'];
            $pro_specification = $row['Specification'];

            echo "
            
                    <div id='single_product_details'>

                        <h3 style='width: max-content; margin-left: 10%;'>$pro_name</h3>
                        <img style='overflow: hidden; margin-left: 6%;' src='admin_area/product_images/$pro_image' alt='Prod_image' width='350vw' height='350vw'/>
                        <div style='float:right; width: 50%;'>
                            <p style='font-size: 1.3vw;'><b>Description</b></p>
                            <p>$pro_desc</p>
                        </div>
                        <p style='margin-left: 15%;'><b>$pro_price $</b></p>
                        <input type='button' class='button' name='add_cart' value='Add to cart' onClick=\"location.href='index.php?add_cart=$pro_id'\" style='float:right; font-size: 1.3vw;'></input>
                        <p style='margin-top: 70px; font-size: 1.3vw;'><b>Specifications</b></p>
                        <p>$pro_specification</p>
                    </div>
            ";
        }
        $run -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function searchFun()
{
    try
    {
        global $con;
        if(isset($_GET['search']))
        {
            $search_query = $_GET['user_query'];

            $get_products = "select * from Products where Keywords like '%$search_query%'";

            $run = $con->query($get_products);

            foreach($run as $row)
            {
                $pro_id = $row['ID_Product'];
                $pro_category = $row['ID_Category'];
                $pro_brand = $row['ID_Brand'];
                $pro_name = $row['Name'];
                $pro_price = $row['Price'];
                $pro_quantity = $row['Availability'];
                $pro_desc = $row['Description'];
                $pro_image = $row['Image'];
                $pro_keywords = $row['Keywords'];

                echo "
                
                        <div id='single_product'>

                            <h3>$pro_name</h3>
                            <img src='admin_area/product_images/$pro_image' alt='Prod_image' width='180' height='180' />
                            <p><b>$pro_price $</b></p>
                            <a href='details.php?pro_id=$pro_id' style='float:left; text-decoration: none; color: black;'}>More details</a>
                            <input type='button' class='button' value='Add to cart' onClick=\"location.href='index.php?add_cart=$pro_id'\" href='index.php?pro_id=$pro_id'></input>

                        </div>

                ";
            }
            $run -> closeCursor();
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

function getPaymentMethods()
{
    try
    {
        global $con;

        $get_methods = "select * from Payment_methods";

        $row_methods = $con->query($get_methods);

        foreach($row_methods as $row)
        {
            $id_method = $row['ID_Method'];
            $method = $row['Name'];
            echo "<option value='$id_method'>$method</option>";
        }
        $row_methods -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
}

?>