<?php
session_start();
if(isset($_SESSION['loggedIn'])  && ($_SESSION['loggedIn'] == true))
{
    header('Location: dashboard.php');
    exit();
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
    <div class="jumbotron loginForm" style="width:50vw">
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login" aria-describedby="emailHelp" placeholder="Wprowadź nazwę użytkownika">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Hasło">
            </div>

            
            <input type="submit" class="btn btn-outline-primary" value="Login"/>
        </form>
        <?php
            if(isset($_SESSION['error'])) echo $_SESSION['error'].'<br/>';
            unset($_SESSION['error']);
        ?>

        
     <a href="register.php" class="btn btn-outline-secondary">Rejestracja</a>        
    </div>


</body>


</html>

