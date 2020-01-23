<?php
session_start();

if(!isset($_SESSION['loggedIn']))
{
    header('Location: index.php');
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

    <div class="jumbotron">
  <h1 class="display-3">Hello <?php echo $_SESSION['user']; ?></h1>
  <p class="lead"><img src="https://pbs.twimg.com/media/EA3KURpXUAI93mA.jpg" style="overflow:none;"/></p>
  <hr class="my-4">


</div>


</body>
</html>

