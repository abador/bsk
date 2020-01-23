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

require_once "navbars.php";

if($_SESSION['usergroup'] == 1  )
{
    $nav = $adminNavbar;
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
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);


        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Klienta</th>
                <th scope="col">Usługa</th>
                <th scope="col">Opis zamówienia</th>
                <th scope="col">Usuń zamówienie</th>
                </tr>
            </thead>
            <tbody>';
        
        while( $row = $result->fetch_assoc() )
         {
             echo '<tr class="table-primary">
                    <th scope="row">'.$row['ID'].'</th>
                    <td>'.$row['clientID'].'</td>
                    <td>'.$row['orderItem'].'</td>
                    <td>'.$row['description'].'</td>
                    <td><form action="removeOrder.php" method="post"><input type="text" class="form-control hide" name="orderRemove" value='.$row['ID'].'><input type="submit" class="btn btn-outline-danger" value="USUŃ"/></form></td>
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