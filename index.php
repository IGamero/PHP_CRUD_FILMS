<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUP - Peliculas</title>
    <link rel="stylesheet" href="./static/css/style.css">
</head>

<body>
    <?php
    require_once('config.php');
    // require_once('./src/Controllers/FilmController.php');
    

    require('./src/views/getFilms.php');

    require('./src/views/postFilm.php');

    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./static/js/filmsForm.js"></script>
</body>

</html>