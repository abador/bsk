<?php
session_start();

if(!isset($_SESSION['loggedIn']))
{
    header('Location: index.php');
    exit();
}
if($_SESSION['usergroup'] != 1)
{
    header('Location: dashboard.php');
    exit();
}

$id = $_POST['orderRemove'];

echo $id;

require_once "connect.php";
$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

if($conn->connect_errno!=0)
{
    throw new Exception(mysqli_connect_errno());
}
else
{
    $sql="DELETE FROM orders WHERE ID = '$id'";
    $conn->query($sql);
    $conn->close();
}

    header('Location: orders.php');
    
?>


