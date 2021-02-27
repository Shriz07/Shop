<?php

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
    echo "Connection failed: " . $e->getMessage();
}

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

            echo "<option value='$cat_id'>$cat_name</option>";
        }
        $row_cats -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }
}

function getBrand()
{
    try
    {
        global $con;

        $get_brands = "select * from Brands";

        $row_brands = $con->query($get_brands);

        foreach($row_brands as $row)
        {
            $brand_id = $row['ID_Brand'];
            $brand_name = $row['Brand_Name'];

            echo "<option value='$brand_id'>$brand_name</option>";
        }
        $row_brands -> closeCursor();
    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }
}

function insertProd()
{
    global $con;
    if(isset($_POST['insert_product']))
    {
        $product_name = $_POST['product_name'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_desc = $_POST['product_description'];
        $product_keywords = $_POST['product_keywords'];
        $product_specification = $_POST['product_specification'];

        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        
        move_uploaded_file($product_image_tmp, "product_images/$product_image");

        $insert_product = "INSERT INTO Products (ID_Category, ID_Brand, Name, Price, Availability, Description, Image, Keywords, Specification) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try
        {
            $stmt = $con -> prepare($insert_product);
            $stmt -> execute([$product_cat, $product_brand, $product_name, $product_price, $product_quantity, $product_desc, $product_image, $product_keywords, $product_specification]);
            echo "<script>alert('Product has been inserted !')</script>";
            echo "<script>window.open('insert_product.php', '_self')</script>";
        }
        catch(PDOException $e)
        {
            //echo "<script>alert('$e')</script>";
            echo "<script>alert('Failed to insert product !')</script>";
            echo "<script>window.open('insert_product.php', '_self')</script>";
        }
    }
}

?>