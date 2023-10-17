<?php
class FilmModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getFilms()
    {
        $sql = "SELECT * FROM `films`";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $films = array();

            while ($row = $result->fetch_assoc()) {
                $films[] = $row;
            }

            return $films;
        } else {
            return false; // Hubo un error en la ejecución de la consulta
        }
    }

    public function getFilm($id)
    {
        $sql = "SELECT * FROM `films` WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $films = array();

            while ($row = $result->fetch_assoc()) {
                $films[] = $row;
            }

            return $films;
        } else {
            return false; // Hubo un error en la ejecución de la consulta
        }
    }

    public function postFilm($title, $description, $year)
    {
        $sql = "INSERT INTO films (title, description, year, isActive) VALUES (?, ?, ?, true)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $description, $year);
        return $stmt->execute();
    }

    public function putFilm($id, $title, $description, $year)
    {
        $sql = "UPDATE films SET title = ?, description = ?, year = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $description, $year, $id);

        return $stmt->execute();
    }

    public function deleteFilm($id)
    {
        $sql = "UPDATE films SET isActive = false WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function deleteFilmPermanent($id)
    {
        $sql = "DELETE FROM `films` WHERE `films`.`id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }




}
?>