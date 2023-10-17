<?php
require_once('config.php');
require_once('./src/Controllers/FilmController.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'get'; // acción predeterminada (get películas)
}

$controller = new FilmController($conn);

if ($action === 'post') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $year = $_POST['year'];

        $resultado = $controller->newFilm($title, $description, $year);
        if ($resultado) {
            header("Location: index.php");
        }
    }

    require('./src/views/postFilm.php');
} elseif ($action === 'get') {
    // Agregar código para get películas aquí
    require('./src/views/getFilms.php');
} else {
    // Manejo de otras actiones (editar, eliminar, etc.)
}
?>