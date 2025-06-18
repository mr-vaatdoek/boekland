<?php
require_once "db-connectie.php";
session_start();
$boeken = [];
$genre = $_GET['genre'];
$results = curl_init('https://www.googleapis.com/books/v1/volumes?q=' . $genre . '&startIndex=0&maxResults=40');
curl_setopt($results, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($results);
curl_close($results);
$boeken = json_decode($response, true);

?>


<!doctype html>
<html lang="en">

<head>
    <title>boekland</title>
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
    <form action="POST">
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

            <div class="row mt-5 border-bottom border-black ">
                <div class="col">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorieën
                        </a>
                        <ul class="dropdown-menu text-center">
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
                <div class="col text-end fs-5">
                    <a href="login.php" class="inloggen">Inloggen</a>
                </div>
                <div class="col text-end fs-5">
                    <a href="afrekenen.php" class="winkelwagen">Winkelwagen</a>
                </div>
            </div>

            <div class="row pt-4">
                <?php
                foreach ($boeken["items"] as $boek) {
                    ?>
                    <div class="card fs-5 mb-2">
                        <div class="card-body">
                            <a href="detail.php?id=<?= $boek['id'] ?>" class="text-decoration-none text-black">

                                <div class="row">
                                    <div class="col-2">
                                        <?php if (array_key_exists('imageLinks', $boek['volumeInfo']) && $boek['volumeInfo']['imageLinks']['thumbnail']) : ?>
                                            <img src="<?= $boek['volumeInfo']['imageLinks']['thumbnail'] ?>" class="img-fluid">
                                        <?php else : ?>
                                            <img src="default.jpg" class="img-fluid">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-unstyled">

                                            <?php if (array_key_exists('volumeInfo', $boek) && array_key_exists('title', $boek['volumeInfo'])) : ?>
                                                <li><b>Titel:</b> <?= $boek['volumeInfo']['title'] ?></li>
                                            <?php endif; ?>
                                            <li><b>Genre:</b> <?= $_GET['genre'] ?></li>
                                            <li><b>pagina's:</b> <?= $boek['volumeInfo']['pageCount'] ?></li>
                                            <?php if (array_key_exists('volumeInfo', $boek) && array_key_exists('authors', $boek['volumeInfo'])) : ?>
                                                <li><b>Auteur:</b> <?= implode(", ", $boek['volumeInfo']['authors']) ?></li>
                                            <?php else : ?>
                                                <li><b>Auteur:</b> Sjaak frisjes</li>
                                            <?php endif; ?>
                                            <?php if (array_key_exists('saleInfo', $boek) && $boek['saleInfo']['saleability'] == 'FOR_SALE') : ?>
                                                <li><b>Prijs:</b> &euro;<?= $boek['saleInfo']['retailPrice']['amount'] ?></li>
                                            <?php else : ?>
                                                <li><b>Prijs:</b> &euro; 30,00</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </form>
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