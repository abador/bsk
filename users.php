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
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Grupa użytkownika</th>
                <th scope="col">Usuń użytkownika</th>
                <th scope="col">Zmień grupę użytkownika</th>
                </tr>
            </thead>
            <tbody>';
        
        while( $row = $result->fetch_assoc() )
         {
             echo '<tr class="table-primary">
                    <th scope="row">'.$row['id'].'</th>
                    <td>'.$row['user'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['usergroup'].'</td>
                    <td><form action="#" method="post"><input type="text" class="form-control hide" name="loginRemove" value='.$row['id'].'><input type="submit" class="btn btn-outline-danger" value="USUŃ"/></form></td>
                    <td>
                        <form action="rank.php" method="post">
                            <input type="text" class="form-control hide" name="loginRemove" value='.$row['id'].'>
                            <input type="text" style="width:50px; float:left;" class="form-control" name="rank">
                            <input type="submit" style="clear:both;" class="btn btn-outline-success" value="Ustaw"/>
                        </form>
                    </td>
                    </tr>
                    ';
         }
         echo'
            </tbody>
        </table> ';


        $conn->close();
    }
    ?>

<div class="card border-danger mb-3 rankInfo" style="max-width: 20rem;">
  <div class="card-body">
    <p class="card-text">Uprawnienia użytkowników według grupy: </p>
    <p class="card-text">0 = klient</p>
    <p class="card-text">1 = administrator</p>
    <p class="card-text">2 = bhp</p>
    <p class="card-text">3 = pracownik</p>
  </div>
</div>

</body>

</html>