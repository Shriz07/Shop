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

function addNewUser()
{
    global $con;
    if(isset($_POST['register']))
    {
        $con->beginTransaction();
        $valid = true;

        $c_name = $_POST['c_name'];
        $c_surname = $_POST['c_surname'];
        $c_email = $_POST['c_email'];
        $c_password = $_POST['c_password'];
        $c_city = $_POST['c_city'];
        $c_name = $_POST['c_name'];
        $c_postal_code = $_POST['c_postal_code'];
        $c_street = $_POST['c_street'];
        $c_home = $_POST['c_home'];
        $c_phone = $_POST['c_phone_number'];


        if(validateEmail($c_email) && checkIfEmailExists($c_email) && validatePassword($c_password) && validatePhone($c_phone))
        {
            $hash = password_hash($c_password, PASSWORD_BCRYPT);

            $last_id = insertAddress($c_city, $c_postal_code, $c_street, $c_home);
            $insert_user = "INSERT INTO Customers (Name, Surname, Email, Password, ID_Address, Phone_number) VALUES(?, ?, ?, ?, ?, ?)";

            try
            {
                $stmt = $con -> prepare($insert_user);
                $stmt -> execute([$c_name, $c_surname, $c_email, $hash, $last_id, $c_phone]);
                $last_id = $con -> lastInsertId();

                $_SESSION['customer_email'] = $c_email;
                $_SESSION['is_admin'] = 0;
                $_SESSION['customer_id'] = $last_id;
                $_SESSION['sort_by'] = 0;

                echo "<script>window.open('index.php', '_self')</script>";
            }
            catch(PDOException $e)
            {
                $con->rollBack();
                echo "<script>createCustomAlert('Failed to register user !', 'customer_register.php');</script>";
            }
        }
        $con->commit();
    }
}

function insertAddress($city, $postal_code, $street, $home)
{
    try
    {
        global $con;
        $get_address = "select ID_Address from addresses where City = '$city' AND Postal_code = '$postal_code' AND Street = '$street' AND Home_number = '$home'";
        $addr = $con->query($get_address);
        foreach($addr as $row)
        {
            $addr_id = $row['ID_Address'];
            return $addr_id;
        }
        $insert_address = "INSERT INTO Addresses (City, Postal_code, Street, Home_number) VALUES (?, ?, ?, ?)";
        $stmt = $con -> prepare($insert_address);
        $stmt -> execute([$city, $postal_code, $street, $home]);
        $last_id = $con -> lastInsertId();
        return $last_id;
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to register user !', 'customer_register.php');</script>";
    }
}

function validateEmail($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<script>createCustomAlert('Email $email invalid !', 'customer_register.php');</script>";
        return false;
    }
    return true;
}

function checkIfEmailExists($email)
{
    try
    {
        global $con;
        $get_users = "select * from Customers";
        $row_users = $con->query($get_users);
        foreach($row_users as $row)
        {
            $emailDB = $row['Email'];
            if($emailDB == $email)
            {
                echo "<script>createCustomAlert('User with that email already exists !', 'customer_register.php');</script>";
                return false;
            }
        }
    }
    catch(PDOException $e)
    {
        echo "<script>createCustomAlert('Failed to connect to database !', 'index.php');</script>";
    }
    return true;
}

function validatePassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) 
    {
        echo "<script>createCustomAlert('Password should have at least 8 characters, at least one upper case letter and one number.', 'customer_register.php');</script>";
        return false;
    }
    return true;
}

function validatePhone($phone)
{
    $str = preg_replace("/[^0-9]/", '', $phone);
    if(strlen($str) != 9)
    {
        echo "<script>createCustomAlert('Phone number should contain 9 numbers.', 'customer_register.php');</script>";
        return false;
    }
    return true;
}

?>