<?php
class FilmModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function newFilm($title, $description, $year)
    {
        $sql = "INSERT INTO films (title, description, year) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $year);
        return $stmt->execute();
    }
}
?>