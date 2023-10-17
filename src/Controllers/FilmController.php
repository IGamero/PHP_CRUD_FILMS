<?php
require_once('../Model/FilmModel.php');
require_once('../../config.php');

class FilmController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new FilmModel($conn);
    }
    public function getFilms()
    {
        $result = $this->model->getFilms();
        return $result;
    }

    public function getFilm($id)
    {
        $result = $this->model->getFilm($id);
        return $result;
    }

    public function postFilm($title, $description, $year)
    {
        $result = $this->model->postFilm($title, $description, $year);
        return $result;
    }

    public function putFilm($id, $title, $description, $year)
    {
        $result = $this->model->putFilm($id, $title, $description, $year);
        return $result;
    }

    public function deleteFilm($id)
    {
        $result = $this->model->deleteFilm($id);
        return $result;
    }

    public function deleteFilmPermanent($id)
    {
        $result = $this->model->deleteFilmPermanent($id);
        return $result;
    }
}

$database = new DatabaseConnection();
$conn = $database->getConnection();

$controller = new FilmController($conn);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            $filmId = $_GET['id'];
            $film = $controller->getFilm($filmId);
            $jsonFilm = json_encode($film);
            echo $jsonFilm;
        } else {
            // De lo contrario, obtén todas las películas
            $films = $controller->getFilms();
            $jsonFilms = json_encode($films);
            echo $jsonFilms;
        }
        break;

    case 'POST':
        // echo "POST";
        $title = $_POST["title"];
        $description = $_POST["description"];
        $year = $_POST["year"];

        $films = $controller->postFilm($title, $description, $year);

        echo $films;
        break;

    case 'PUT':
        $filmId = $_GET['id'];
        $put_data = json_decode(file_get_contents("php://input"));

        $title = $put_data->title;
        $description = $put_data->description;
        $year = $put_data->year;

        $films = $controller->putFilm($filmId, $title, $description, $year);
        echo $films;
        break;

    case 'DELETE':
        // echo "DELETE";
        $filmId = $_GET['id'];

        $films = $controller->deleteFilm($filmId);
        // $films = $controller->deleteFilmPermanent($filmId); // Borrar datos permanentemente (No recomendado)
        echo $films;
        break;

    default:
        echo "Error";
        break;
}
?>