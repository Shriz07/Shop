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
    echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
}

function deleteItemFromCart()
{
    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "delete")
        {
            foreach($_SESSION["Shopping_cart"] as $keys => $values)
            {
                if($values["prod_id"] == $_GET["id"])
                {
                    unset($_SESSION["Shopping_cart"][$keys]);
                    $_SESSION['Total_items'] -= 1;
                    if(!isset($_SESSION["Shopping_cart"][0]))
                        $_SESSION['Total_price'] = 0;
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
}

function cart()
{
    if(isset($_GET['add_cart']))
    {
        if(isset($_SESSION["Shopping_cart"][0]))
        {
            $item_array_id = array_column($_SESSION["Shopping_cart"], "prod_id");
            if(!in_array($_GET["add_cart"], $item_array_id))
            {
                $count = count($_SESSION["Shopping_cart"]);
                $item_array = array(
                    'prod_id' => $_GET["add_cart"],
                    'prod_quantity' => 1
                );
                $_SESSION["Shopping_cart"][$count] = $item_array;
                $_SESSION["Total_items"] += 1;
            }
            else
            {
                echo "<script>createCustomAlert('Item already added !', 'index.php');</script>";
            }
        }
        else
        {
            //echo "<script>alert('added')</script>";
            $item_array = array(
                'prod_id' => $_GET["add_cart"],
                'prod_quantity' => 1
            );
            $_SESSION["Shopping_cart"][0] = $item_array;
            $_SESSION['Total_items'] = 1;
            /*$prod_idd = $_GET["add_cart"];
            echo "<script>alert($prod_idd)</script>";*/
        }
    }
}

function displayCart()
{
    if(!empty($_SESSION["Shopping_cart"]))
    {
        global $con;
        $total_price = 0;
        foreach($_SESSION["Shopping_cart"] as $keys => $values)
        {

            $get_products = "select * from Products where ID_Product='$values[prod_id]'";

            $run = $con->query($get_products);
            foreach($run as $row)
            {
                $total_item_price = $values["prod_quantity"] * $row["Price"];
                $pro_image = $row['Image'];
                $price = number_format((float)$row['Price'], 2, '.', '');
                $total_disp = number_format((float)$total_item_price, 2, '.', '');
                echo "
                    <tr align='center' style='font-size: 1.1vw;'>
                        <td>$row[Name]</td>
                        <td><img src='admin_area/product_images/$pro_image' alt='Prod_image' width='70vw' height='70vw'/></td>
                        <td><input type='text' class='textBox' size='4' name='qty[$values[prod_id]]' placeholder='$values[prod_quantity]'/></td>";
                        echo updateCart($values['prod_id']);
                echo "
                        <td>$ $price</td>
                        <td>$ $total_disp</td>
                        <td><a href='cart.php?action=delete&id=$values[prod_id]'>Remove</a></td>
                    </tr>
                ";
                $total_price = $total_price + $total_item_price;
                $_SESSION['Total_price'] = $total_price;
            }
        }
        echo "
            <tr style='font-size: 1.2vw;'>
                <td colspan='5' align='right'><b>Total: </b></td>
                <td colspan='6' align='left'><b>$$total_price <b></td>
            </tr>
            <tr class='spacer' style='height: 1vw;'></tr>";
        if(isset($_SESSION['customer_email']))
        {
            echo "
            <tr align='right' style='padding-top: 100px;'>
                <td colspan='5'><input type='submit' class='button' name='update_cart' value='Update Cart'/></td>
                <td colspan='6'><input type='button' class='button' name='checkout' value='Checkout' onClick=\"location.href='checkout.php'\"/></td>
            </tr>
            ";
        }
        else
        {
            echo "
            <tr align='right' style='padding-top: 100px;'>
                <td colspan='5'><input type='submit' class='button' name='update_cart' value='Update Cart'/></td>
                <td colspan='6'><input type='button' class='button' name='checkout' value='Checkout' onClick=\"location.href='customer_login.php'\"/></td>
            </tr>
            ";
        }
    }
}

function updateCart($id)
{
    if(isset($_POST['update_cart']) && isset($_POST['qty'][$id]))
    {
        $new_qty = $_POST['qty'][$id];
        if($new_qty != null && $new_qty > 0)
        {
            foreach($_SESSION["Shopping_cart"] as $keys => $values)
            {
                if($values['prod_id'] == $id)
                {
                    $_SESSION["Shopping_cart"][$keys]['prod_quantity'] = $new_qty;
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
}

?>