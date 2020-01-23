<?php
session_start();
if(!isset($_SESSION['registerSuccess']))
{
    header('Location: index.php');
    exit();
}
else
{
    unset($_SESSION['registerSuccess']);
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
<div class="jumbotron">
  <p class="lead">Dziękujemy za rejestrację. Możesz już zalogować się na konto</p>
  <hr class="my-4">
  <p class="lead">
  <a href="index.php" class="btn btn-primary btn-lg">Zaloguj się na swoje konto</a>
  </p>
</div>
</body>


</html>

