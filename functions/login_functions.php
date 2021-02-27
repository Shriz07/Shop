<?php

$servername = "localhost";
$username = "root";
$password = "";
$msg = "";

try
{
    $con = new PDO("mysql:host=$servername;dbname=ITShop", $username, $password);
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) 
{
    echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
}

function loginUser()
{
    global $con;
    if(isset($_POST['login']))
    {
        $c_email = $_POST['email'];
        $c_password = $_POST['pass'];
        $hash = password_hash($c_password, PASSWORD_BCRYPT);

        $get_user = "SELECT ID_Customer, Email, Password, Is_Admin FROM customers WHERE Email=:email";
        try
        {
            $stmt = $con->prepare($get_user);
            $stmt->execute(['email' => $c_email,]);

            if($stmt->rowCount() > 0)
            {
                
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($c_password, $data['Password']))
                {
                    echo "<script>createCustomAlert('Login success !', 'index.php');</script>";
                    $_SESSION['customer_email'] = $c_email;
                    $_SESSION['is_admin'] = $data['Is_Admin'];
                    $_SESSION['customer_id'] = $data['ID_Customer'];
                    $_SESSION['sort_by'] = $data['Is_Admin'];
                }
                else
                    echo "<script>createCustomAlert('Wrong password !', 'customer_login.php');</script>";
            }
            else
            {
                echo "<script>createCustomAlert('Login failed !', 'customer_login.php');</script>";
            }
        }
        catch(PDOException $e)
        {
            echo "<script>createCustomAlert('Failed to login user !', 'customer_login.php');</script>";
        }
    }
}

function checkUserLogged()
{
    if(!isset($_SESSION['customer_email']))
    {
        echo "<a href='customer_login.php'>Login</a>";
    }
    else
    {
        if($_SESSION['is_admin'] == 1)
        {
            echo "<a href='all_orders.php'>Manage orders</a>";
            echo "<a href='admin_area/insert_product.php'>Add products</a>";
        }
        else
        {
            echo "<a href='all_orders.php'>My orders</a>";
            echo "<a href='cart.php'>Go to cart</a>";
        }
        echo "<a href='functions/logout.php'>Logout</a>";
    }
}
?>