<?php
session_start();
if(isset($_SESSION['loggedIn'])  && ($_SESSION['loggedIn'] == true))
{
    header('Location: dashboard.php');
    exit();
}

if(isset($_POST['email']))
{
    //udana walidacja
    $ok = true;
    //check nickname
    $nick = $_POST['nick'];
    if(strlen($nick) < 3 || strlen($nick) > 20)
    {
        $ok = false;
        $_SESSION['eNick'] = "Nazwa użytkownika musi posiadać od 3 do 2 znaków";
    }
    if(ctype_alnum($nick) == false)
    {
        $ok = false;
        $_SESSION['eNick'] = "Nazwa użytkownika może zawierać tylko litery i cyfry (bez polskich znaków)";
    }
    //check mail
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $ok=false;
        $_SESSION['eMail'] = "Podaj poprawny adres email";
    }
    //check password
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    if((strlen($pass)) < 5 || (strlen($pass)) > 25)
    {
        $ok=false;
        $_SESSION['ePassword'] = "Hasło musi zawierać od 5 do 25 znaków";
    }
    if($pass != $pass1)
    {
        $ok=false;
        $_SESSION['ePassword1'] = "Podane hasła nie są identyczne";
    }
    //akceptacja regulaminu
    if(!isset($_POST['regulamin']))
    {
        $ok=false;
        $_SESSION['eRegulamin'] = "Potwierdź akceptację regulaminu";
    }


require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
    $conn = new mysqli($host, $dbUser, $dbPassword, $dbName);
    if($conn->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {
        //mail duplicate check
        $result = $conn->query("SELECT id FROM users WHERE email='$email'");
        if(!$result) throw new Exception($conn->error);
        $mailAmount = $result->num_rows;
        if($mailAmount > 0)
        {
            $ok=false;
            $_SESSION['eMail'] = "Isnieje już konto przypisane do tego maila";
        }
        //nick duplicate check
        $result = $conn->query("SELECT id FROM users WHERE user='$nick'");
        if(!$result) throw new Exception($conn->error);
        $nickAmount = $result->num_rows;
        if($nickAmount > 0)
        {
            $ok=false;
            $_SESSION['eNick'] = "Isnieje już konto z podaną nazwą użytkownika";
        }

        if($ok == true)
        {
            //ok
            if($conn->query("INSERT INTO users VALUES (NULL, '$nick', '$pass', '$email', 0, '', '' ,'')"))
            {
                $_SESSION['registerSuccess']=true;
                header('Location: welcome.php');
            }
            else
            {
                throw new Exception($conn->error);
            }
        }

        $conn->close();
    }
}
    catch(Exception $e)
    {
        echo 'Błąd rejestracji';
        echo $e;
    }

}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Projekt</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
<div class="card text-white bg-secondary mb-3 reg" style="max-width: 20rem;">
  <div class="card-header">Zarejestruj się</div>
  <div class="card-body">
  <form method="post">
  <div class="form-group">
      <label for="nick">Username</label>
      <input type="text" name="nick" class="form-control" id="nick" aria-describedby="emailHelp" placeholder="Wprowadź nazwę użytkownika">
    </div>
        <?php 
            if(isset($_SESSION['eNick'])) { echo '<div class="error">'.$_SESSION['eNick'].'</div>'; }
            unset($_SESSION['eNick']);
        ?>
        
<div class="form-group">
      <label for="email">Adres email</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Adres email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
        <?php 
            if(isset($_SESSION['eMail'])) { echo '<div class="error">'.$_SESSION['eMail'].'</div>'; }
            unset($_SESSION['eMail']);
        ?>

<div class="form-group">
      <label for="password">Hasło</label>
      <input type="password" name="pass" class="form-control" id="password" placeholder="Hasło">
    </div>
        <?php 
            if(isset($_SESSION['ePassword'])) { echo '<div class="error">'.$_SESSION['ePassword'].'</div>'; }
            unset($_SESSION['ePassword']);
        ?>

<div class="form-group">
      <label for="password1">Powtórz hasło</label>
      <input type="password" name="pass1" class="form-control" id="password1" placeholder="Powtórz hasło">
    </div>
        <?php 
            if(isset($_SESSION['ePassword1'])) { echo '<div class="error">'.$_SESSION['ePassword1'].'</div>'; }
            unset($_SESSION['ePassword1']);
        ?>

        <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" name="regulamin" type="checkbox" value="">
          Rejestrując się akceptuję <a href="#">regulamin</a>
        </label>
      </div>

        <?php 
            if(isset($_SESSION['eRegulamin'])) { echo '<div class="error">'.$_SESSION['eRegulamin'].'</div>'; }
            unset($_SESSION['eRegulamin']);
        ?>

     <!--   <div class="g-recaptcha" data-sitekey="6LeEPc8UAAAAAE7x6krWrYSBTplY27swmSw5GEU8"></div>  -->
        <?php /*
            if(isset($_SESSION['eBot'])) { echo '<div class="error">'.$_SESSION['eBot'].'</div>'; }
            unset($_SESSION['eBot']);
            */
        ?>

        <br />
        <input type="submit" class="btn btn-primary" value="zarejestruj się"/>
    </form>

    <a href="index.php" class="btn btn-primary">Wróć</a>
  </div>
    
</body>
</html>

