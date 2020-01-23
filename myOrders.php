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

require_once "navbars.php";

if($_SESSION['usergroup'] == 1  )
{
    $nav = $adminNavbar;
}
else if($_SESSION['usergroup'] == 2  )
{
    $nav = $bhpNavbar;
}
else if($_SESSION['usergroup'] == 3  )
{
    $nav = $workerNavbar;
}
else
{
    $nav = $clientNavbar;
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Projekt</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php $ordid = $_SESSION['id']; ?>

<?php echo $nav; ?>


    <?php
    require_once "connect.php";
    $conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

    if($conn->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {   
        $sql = "SELECT * FROM orders WHERE clientID = '$ordid' ";
        $result = $conn->query($sql);

        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Zamówienie</th>
                <th scope="col">Szczegóły</th>
                </tr>
            </thead>
            <tbody>';
        
        while( $row = $result->fetch_assoc() )
         {
             echo '<tr class="table-primary">
                    <th scope="row">'.$row['orderItem'].'</th>
                    <td>'.$row['description'].'</td>
                    </tr>
                    ';
         }
         echo'
            </tbody>
        </table> ';


        $conn->close();
    }
    ?>



</body>
</html>