<?php

    session_start();

    if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $conn = @new mysqli($host, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_errno!=0)
    {
        echo "error: ".$conn->connect_errno."Opis: ".$conn->connect_error;
    }
    else 
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

    //    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    //    $password = htmlentities($password, ENT_QUOTES, "UTF-8");



        $sql = "SELECT * FROM users WHERE user='$login' AND pass='$password'";

        if ($result = @$conn->query($sql))
      //      sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'",
      //      mysqli_real_escape_string($conn,$login),
      //      mysqli_real_escape_string($conn,$password))))
        {
            $users = $result->num_rows;
            if($users > 0 )
            {
                $_SESSION['loggedIn'] = true;
                
                $row = $result->fetch_assoc(); //id, user, pass, email, admin
                $_SESSION['user'] = $row['user'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                //1 kierownik i zast kierownika, 2 bhp, 3 pracownik, 0 klient
                $_SESSION['usergroup'] = $row['usergroup']; 

                unset($_SESSION['error']);
                $result->close();

                header('Location: dashboard.php');
            }   
            else 
            {
                $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło</span>';
                header('Location: index.php');
            }
        }

        $conn->close();
    }

    

    
//echo $login."<br>";
//echo $password;

?>

