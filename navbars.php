<?php
$adminNavbar =' 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboard.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="users.php">Użytkownicy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Zamówienia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pracownicy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Grafik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Zamów dostawę</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Zaplanowane dostawy</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="#">Cennik</a>
            </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-primary" href="logout.php">Logout</a>
        </form>
    </nav>';

$clientNavbar ='
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="order.php">Zamów</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="myOrders.php">Moje zamówienia</a>
        </li>
        </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </form>
</nav>';

//--------------------------------------------------
$bhpNavbar ='
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Ustal szkolenie bhp</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Przejrzyj szkolenia</a>
        </li>
        </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </form>
</nav>';

$workerNavbar ='
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Przejrzyj szkolenia</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Zaplanowane dostawy</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Grafik</a>
        </li>
        </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </form>
</nav>';

?>
