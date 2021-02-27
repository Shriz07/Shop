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

function displayOrder()
{
    try
    {
        global $con;

        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "details")
            {
                $orderID = $_GET["id"];

                $get_products = "select * from ordered_products where ID_Order=$orderID";
                $run = $con->query($get_products);
                foreach($run as $row)
                {
                    $productID = $row['ID_Product'];
                    $quantity = $row['Quantity'];

                    $get_product = "select Name, Image, Price, Availability from products where ID_Product=$productID";
                    $run2 = $con->query($get_product);
                    foreach($run2 as $product)
                    {
                        $image = $product['Image'];
                        $prod_price = $product['Price'];
                        $price_disp = number_format((float)$prod_price, 2, '.', '');

                        echo "
                        <tr align='center' style='font-size: 1.1vw;'>
                        <td>$product[Name]</td>
                        <td><img src='admin_area/product_images/$image' alt='Prod_image' width='70vw' height='70vw'/></td>
                        <td>$quantity</td>
                        <td>$price_disp $</td>
                        <td>$product[Availability]</td>
                        ";
                    }
                }
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to display order !', 'index.php');</script>";
    }
}

function displayAddress()
{
    try
    {
        global $con;

        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "details")
            {
                $addressID = $_GET['addr'];

                $get_address = "select * from addresses where ID_Address=$addressID";
                $run3 = $con->query($get_address);
                foreach($run3 as $address)
                {
                    echo "
                    <div class='orderAddress'>
                        <h3 align='center' style='font-size: 1.5vw;'>Order Address</h3>
                            <table align='center'>
                            <tr style='font-size: 1.2vw;'>
                                <td align='right' style='font-weight: bolder;'>City:</td>
                                <td align='left'>$address[City]</td>
                            </tr>
                            <tr style='font-size: 1.2vw;'>
                                <td align='right' style='font-weight: bolder;'>Postal code:</td>
                                <td align='left'>$address[Postal_code]</td>
                            </tr>
                            <tr style='font-size: 1.2vw;'>
                                <td align='right' style='font-weight: bolder;'>Street:</td>
                                <td align='left'>$address[Street]</td>
                            </tr>
                            <tr style='font-size: 1.2vw;'>
                                <td align='right' style='font-weight: bolder;'>Home number:</td>
                                <td align='left'>$address[Home_number]</td>
                            </tr>
                            </table> 
                        </form>
                    </div>
                    ";
                }
                
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to display order !', 'index.php');</script>";
    }
}

function displayUserOrders()
{
    try
    {
        global $con;

        $get_orders = "select * from Orders where ID_Customer=$_SESSION[customer_id]";
        $result = $con->query($get_orders);
        foreach($result as $row)
        {
            $ID_Order = $row["ID_Order"];
            $ID_Payment = $row["ID_Payment"];
            $ID_Status = $row["ID_Status"];
            $ID_Address = $row["ID_Address"];

            $get_payment = "select * from Payments where ID_Payment=$ID_Payment";
            $payment = $con->query($get_payment);
            $total_cost = 0;
            foreach($payment as $row2)
                $total_cost = $row2["Amount"];
            $total_disp = number_format((float)$total_cost, 2, '.', '');

            $get_status = "select Status from statuses where ID_Status=$ID_Status";
            $stmt = $con->query($get_status);
            $res = $stmt->fetch();
            $current_status = $res['Status'];

            echo "
                <tr align='center' style='font-size: 1.1vw;'>
                <td>$ID_Order</td>
                <td>$ID_Payment</td>
                <td>$total_disp $</td>
                <td><a href='order_details.php?action=details&id=$ID_Order&addr=$ID_Address'>Details</a></td>
                <td>$current_status</td>
        </tr>
            ";
        }    
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to display orders !', 'index.php');</script>";
    }
}

function displayTitle()
{
    if(isset($_SESSION['sort_by']))
    {
        if($_SESSION['sort_by'] == 1)
            echo "Manage orders awaiting accept";
        else if($_SESSION['sort_by'] == 2)
            echo "Manage orders awaiting delivery";
        else
            echo "My orders";
    }
}

function changeSort()
{
    if(isset($_GET['changeSort']))
    {
    if($_SESSION['sort_by'] == 1)
        $_SESSION['sort_by'] = 2;
    else
        $_SESSION['sort_by'] = 1;
    }
}

function displayAllOrders()
{
    try
    {
        global $con;

        $get_orders = "select * from Orders";
        $result = $con->query($get_orders);
        foreach($result as $row)
        {
            $ID_Order = $row["ID_Order"];
            $ID_Customer = $row["ID_Customer"];
            $ID_Payment = $row["ID_Payment"];
            $ID_Status = $row["ID_Status"];
            $ID_Address = $row["ID_Address"];
            if($ID_Status != $_SESSION['sort_by'])
                continue;

            $get_payment = "select * from Payments where ID_Payment=$ID_Payment";
            $payment = $con->query($get_payment);
            $text = "Yes";
            foreach($payment as $row2)
            {
                if($row2["Is_paid"] == 0)
                    $text = "No";
            }


            echo "
                <tr align='center' style='font-size: 1.1vw;'>
                    <td>$ID_Order</td>
                    <td>$ID_Customer</td>
                    <td>$ID_Payment</td>
                    <td>$text</td>
                    <td><a href='order_details.php?action=details&id=$ID_Order&addr=$ID_Address'>Details</a></td>
                    <td><a href='all_orders.php?action=accept&id=$ID_Order'>Accept</a></td>
                    <td><a href='all_orders.php?action=cancel&id=$ID_Payment'>Cancel</a></td>
                </tr>
            ";
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to display orders !', 'index.php');</script>";
    }
}

function cancelOrder()
{
    try
    {
        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "cancel")
            {
                global $con;
                $paymentID = $_GET["id"];
                $sql = "DELETE FROM Payments WHERE ID_Payment=$paymentID";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to cancel order !', 'index.php');</script>";
    }
}

function acceptOrder()
{
    try
    {
        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "accept")
            {
                global $con;
                $orderID = $_GET["id"];
                $sql = "UPDATE Orders SET ID_Status=ID_Status+1 WHERE ID_Order=$orderID AND ID_Status < 3";
                $stmt = $con->prepare($sql);
                $stmt->execute();
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed accept order !', 'index.php');</script>";
    }
}

?>