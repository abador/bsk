<?php
session_start();

if(!isset($_SESSION['loggedIn']))
{
    header('Location: index.php');
    exit();
}
if($_SESSION['usergroup'] != 0)
{
    header('Location: dashboard.php');
    exit();
}

$service = $_POST['serv'];

if($service == '')
{
    $_SESSION['orderFail'] = 'wybierz zamówienie';
    header('Location: order.php');
    exit();
}

$opis = $_POST['desc'];
$idClient = $_SESSION['id'];
// $opis = htmlentities($opis, ENT_QUOTES, "UTF-8");

require_once "connect.php";
$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

if($conn->connect_errno!=0)
{
    throw new Exception(mysqli_connect_errno());
}
else
{
    $sql="INSERT INTO orders VALUES (NULL, '$idClient', '$service', '$opis')";
    $conn->query($sql);
    $conn->close();
}
    $_SESSION['orderSuccess'] = "Zamówienie zakończone sukcesem";
    header('Location: order.php');
    
?>


