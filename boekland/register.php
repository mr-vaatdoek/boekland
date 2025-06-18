
<?php
require_once "db-connectie.php";
session_start();

unset($_SESSION['error']);


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

    $stmt = $connectie->prepare($query);
    $stmt->bindparam(1, $_POST['gebruikersnaam']);
    $stmt->bindparam(2, $_POST['password']);
    $stmt->bindparam(3, $_POST['email']);

    $stmt->execute();
}


if (isset($_GET['genre'])) {
    $boeken = [];
    $genre = $_GET['genre'];
    $query = 'SELECT * FROM inhoud where genres = ?';
    $stmt = $connectie->prepare($query);
    $stmt->execute([$genre]);
} else {
    $query = 'SELECT * FROM inhoud';
    $stmt = $connectie->prepare($query);
    $stmt->execute();
}
$boeken = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($boeken)) {
    echo "<p>Geen boeken gevonden in deze categorie.</p>";
} else {
    foreach ($boeken as $boek) {
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>login</title>

    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container vh-100">

        <div class="row">
            <div class="col">
                <img src="logo-boekland.png" alt="logo-boekland.png" width="155px" height="80px">
            </div>
            <div class="col text-end ">
                <p>Gratis verzending vanaf € 30,00</p>
            </div>
            <div class="col text-end">
                <p>Klantbeoordeling (5.0) ★★★★★ </p>
            </div>
            <div class="col text-end">
                <p>Vandaag voor 22:00 besteld, morgen in huis</p>
            </div>
        </div>

        <div class="row mt-5 border-bottom border-black ">
            <div class="col">
                <div class="dropdown">
                    <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorieën
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">horror</a></li>
                        <li><a class="dropdown-item" href="#">thriller</a></li>
                        <li><a class="dropdown-item" href="#">educatief</a></li>
                        <li><a class="dropdown-item" href="#">sport</a></li>
                        <li><a class="dropdown-item" href="#">misdaad / mysterie</a></li>
                        <li><a class="dropdown-item" href="#">fictie</a></li>
                        <li><a class="dropdown-item" href="#">avontuur / actie</a></li>
                    </ul>
                </div>
            </div>
            <div class="col text-center fs-5">
                <input type="text" placeholder="zoeken">
            </div>
            <div class="col text-end fs-5">
                <a href="login.php" class="inloggen">Inloggen</a>
            </div>
            <div class="col text-end fs-5">
                <a href="afrekenen.php" class="winkelwagen">Winkelwagen</a>
            </div>
        </div>

        <div class="row justify-content-center h-75 align-items-center">
            <div class="col-md-6 col-lg-4">
                <p class="text-center fs-1 mb-5">Registreer</p>
                <div class="card">

                    <div class="card-body">
                        <form method="POST">
                            <p class="fs-4">Meld je aan bij onze site!</p>
                            <div>
                                <label for="email">Email:</label>
                                <input type="email" class="form-control mt-2" name="email" id="email">
                            </div>
                            <div>
                                <label for="gebruikersnaam">gebruikersnaam</label>
                                <input type="text" class="form-control mt-2" name="gebruikersnaam" id="gebruikersnaam">
                            </div>
                            <div>
                                <label for="password">Wachtwoord</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                            <div>
                                <input type="submit" value="aanmelden" class="btn btn-primary mt-4">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
</body>

</html>