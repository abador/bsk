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
    <div class="card text-white bg-secondary mb-3 mid" style="max-width: 20rem;">

  <div class="card-header">Zamów</div>
  <div class="card-body">
    <h4 class="card-title">
    <?php
        if(isset($_SESSION['orderSuccess']))
        {
          echo  '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['orderSuccess'].'</strong>
                </div>';
                unset($_SESSION['orderSuccess']);
        }


        if(isset($_SESSION['orderFail']))
        {
            echo  '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['orderFail'].'</strong>
                </div>';
                unset($_SESSION['orderFail']);
        }
    ?>
    </h4>

    <div class="form-group">

    <form action="dborder.php" method="post">
    <select style="margin-bottom:5px;" class="custom-select" style="float:left;" name="serv">
      <option value ='' selected="">Wybierz usługę</option>
      <option value="Usluga 1">Usluga 1</option>
      <option value="Usluga 2">Usluga 2</option>
      <option value="Usluga 3">Usluga 3</option>
    </select>
    <textarea rows="4" cols="50" class="form-control" style="margin-bottom:5px;" name="desc" placeholder="szczegóły zamówienia"></textarea>
    <input type="submit" class="btn btn-outline-success" value="Zamów"/>
    </form>


  </div>
  </div>
</div>


</div>


</body>
</html>