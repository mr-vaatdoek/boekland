<?php
require_once "db-connectie.php";
session_start();
$boeken = [];
if (!isset($_GET['id'])) {
    header("Location: index.php");
}
$id = $_GET['id'];
$results = file_get_contents('https://www.googleapis.com/books/v1/volumes/' . $id);
$boeken = json_decode($results, true);
if (isset($_POST['btn'])) {
    if (!isset($_SESSION['books']) || !is_array($_SESSION['books'])) {
        $_SESSION['books'] = [];
    }
    if (isset($_GET['id'])) {
        $_SESSION['books'][] = $_GET['id'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>

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
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="index.php">
                    <img src="logo-boekland.png" alt="logo-boekland.png" width="155px" height="80px">
                </a>
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
        <div class="row mt-5 border-bottom border-black">
            <div class="col">
                <div class="dropdown">
                    <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorieën
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="genre.php?genre=horror">horror</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=thriller">thriller</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=educatief">educatief</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=sport">sport</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=misdaad/mysterie">misdaad / mysterie</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=fictie">fictie</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=avontuur/actie">avontuur / actie</a></li>
                    </ul>
                </div>
            </div>
            <div class="col text-center fs-5">
                <input type="text" placeholder="zoeken">
            </div>
            <div class="col text-end fs-5 knoppen">
                <a href="login.php" class="inloggen">Inloggen</a>
            </div>
            <div class="col text-end fs-5">
                <a href="afrekenen.php" class="winkelwagen">Winkelwagen</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col m-0 p-0 text-center card">
                <?php if (array_key_exists('imageLinks', $boeken['volumeInfo']) && $boeken['volumeInfo']['imageLinks']['thumbnail']) : ?>
                    <img src="<?= $boeken['volumeInfo']['imageLinks']['thumbnail'] ?>" class="img-fluid">
                <?php else : ?>
                    <img src="default.jpg" class="img-fluid">
                <?php endif; ?>
            </div>
            <div class="col d-flex justify-content-center flex-column  p-4 fs-5 ">
                <div class="row pt-4 gy-3">
                    <a href="detail.php?id=' <?php $boeken['id'] ?> '" class="text-decoration-none text-black">
                        <div class="col">
                            <div class="fs-3">
                                <ul class="list-unstyled ">
                                    <?php if (array_key_exists('volumeInfo', $boeken) && array_key_exists('title', $boeken['volumeInfo'])) : ?>
                                        <li class="mt-3"><b>Titel:</b> <?= $boeken['volumeInfo']['title'] ?></li>
                                    <?php endif; ?>
                                    <li class="mt-3"><b>pagina's:</b> <?= $boeken['volumeInfo']['pageCount'] ?></li>
                                    <?php if (array_key_exists('volumeInfo', $boeken) && array_key_exists('authors', $boeken['volumeInfo'])) : ?>
                                        <li class="mt-3"><b>Auteur:</b> <?= implode(", ", $boeken['volumeInfo']['authors']) ?></li>
                                    <?php else : ?>
                                        <li class="mt-3"><b>Auteur:</b> Sjaak frisjes</li>
                                    <?php endif; ?>
                                    <?php if (array_key_exists('saleInfo', $boeken) && $boeken['saleInfo']['saleability'] == 'FOR_SALE') : ?>
                                        <li class="mt-3"><b>Prijs:</b> &euro;<?= $boeken['saleInfo']['retailPrice']['amount'] ?></li>
                                    <?php else : ?>
                                        <li><b>Prijs:</b> &euro; 30,00</li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                    </a>
                </div>
            </div>

            <div class="row mt-4 fs-4">
                <p>op vooraad</p>
                <p> voor 22:00 besteld, morgen in huis </p>
            </div>
            <div class="mt-5">
                <form action="" method="post" class="">
                    <button>
                        <input class="bg-info border-2 rounded-4 p-2 bg-opacity-25" type="submit" value="Voeg toe aan je winkelwagen" name="btn">
                    </button>
                </form>
            </div>
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