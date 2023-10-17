<?php
require_once('./src/Model/FilmModel.php');

class FilmController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new FilmModel($conn);
    }

    public function newFilm($title, $description, $year)
    {
        $result = $this->model->newFilm($title, $description, $year);
        return $result;
    }
}
?>