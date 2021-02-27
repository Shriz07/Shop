<?php

$con = mysqli_connect("localhost", "root", "", "ITShop");

if ($con -> connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

?>