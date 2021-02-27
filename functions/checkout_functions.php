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

function displayCheckoutData($index)
{
    try
    {
        global $con;
        if(isset($_SESSION['customer_email']))
        {
            $email = $_SESSION['customer_email'];
            $stmt = $con->prepare("SELECT * from customers where Email='$email'");
            $stmt->execute();
            $customer = $stmt->fetch();
            $_SESSION['Customer_ID'] = $customer['ID_Customer'];

            $stmt = $con->prepare("SELECT * from addresses where ID_Address='$customer[ID_Address]'");
            $stmt->execute();
            $address = $stmt->fetch();

            switch($index)
            {
                case 1:
                    echo "value=$customer[Name]";
                    break;
                case 2:
                    echo "value=$customer[Surname]";
                    break;
                case 3:
                    echo "value=$customer[Phone_number]";
                    break;
                case 4:
                    echo "value=$address[City]";
                    break;
                case 5:
                    echo "value=$address[Postal_code]";
                    break;
                case 6:
                    echo "value=$address[Street]";
                    break;
                case 7:
                    echo "value=$address[Home_number]";
                    break;
            }           

        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to display orders !', 'index.php');</script>";
    }
}

function insertAddress()
{
    try
    {
        global $con;
        $c_city = $_POST['c_city'];
        $c_postal_code = $_POST['c_postal_code'];
        $c_street = $_POST['c_street'];
        $c_home = $_POST['c_home'];
        $get_address = "select ID_Address from addresses where City = '$c_city' AND Postal_code = '$c_postal_code' AND Street = '$c_street' AND Home_number = '$c_home'";
        $addr = $con->query($get_address);
        foreach($addr as $row)
        {
            $addr_id = $row['ID_Address'];
            return $addr_id;
        }
        $insert_address = "INSERT INTO Addresses (City, Postal_code, Street, Home_number) VALUES (?, ?, ?, ?)";
        $stmt = $con -> prepare($insert_address);
        $stmt -> execute([$c_city, $c_postal_code, $c_street, $c_home]);
        $last_id = $con -> lastInsertId();
        return $last_id;
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to place order ! ', 'index.php');</script>";
    }
}

function placeOrder()
{
    try
    {
        if(isset($_POST['orderConfirm']))
        {
            $c_payment = $_POST['payment_method'];

            global $con;
            $con->beginTransaction();
            $c_id = $_SESSION['Customer_ID'];
            $stmt = $con->prepare("SELECT * from customers where ID_Customer='$c_id'");
            $stmt->execute();
            $customer = $stmt->fetch();

            //Insert new payment
            $insert_payment = "INSERT INTO Payments (ID_Method, Is_paid, Amount) VALUES (?, ?, ?)";
            $stmt = $con -> prepare($insert_payment);
            $stmt -> execute([$c_payment, 1, $_SESSION['Total_price']]);
            $last_id = $con -> lastInsertId();

            $id_addr = insertAddress();
            //Insert order
            $insert_order = "INSERT INTO Orders (ID_Customer, ID_Status, ID_Address, ID_Payment) VALUES (?, ?, ?, ?)";
            $stmt = $con -> prepare($insert_order);
            $stmt -> execute([$c_id, 1, $id_addr, $last_id]);
            $last_id = $con -> lastInsertId();
            
            //Insert ordered products
            foreach($_SESSION["Shopping_cart"] as $keys => $values)
            {
                $insert_product = "INSERT INTO ordered_products (ID_Order, ID_Product, Quantity) VALUES (?, ?, ?)";
                $stmt = $con -> prepare($insert_product);
                $stmt -> execute([$last_id, $values['prod_id'], $values['prod_quantity']]);
                unset($_SESSION["Shopping_cart"][$keys]);
            }
            $_SESSION['Total_items'] = 0;
            $_SESSION['Total_price'] = 0;
            $con->commit();
            echo "<script>createCustomAlert('Order placed !', 'index.php');</script>";
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to place order !', 'checkout.php');</script>";
        $con->rollBack();
    }
}

?>