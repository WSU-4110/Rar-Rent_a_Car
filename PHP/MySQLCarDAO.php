<?php
require_once 'Car.php';
require_once 'CarDAO.php';

class MySQLCarDAO implements CarDAO {
    private $conn;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->conn = new PDO($dsn, $username, $password);
            // Set error mode to exception for better error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getCarById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Car($row['id'], $row['type'], $row['color'], $row['condition']);
        }
        return null;
    }

    public function getAllCars() {
        $stmt = $this->conn->query("SELECT * FROM cars");
        $cars = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cars[] = new Car($row['id'], $row['type'], $row['color'], $row['condition']);
        }
        return $cars;
    }

    public function addCar(Car $car) {
        $stmt = $this->conn->prepare("INSERT INTO cars (type, color, `condition`) VALUES (:type, :color, :condition)");
        $stmt->bindParam(':type', $car->getType());
        $stmt->bindParam(':color', $car->getColor());
        $stmt->bindParam(':condition', $car->getCondition());
        $stmt->execute();
        // Optionally, update the car's id if your model supports it:
        // $car->setId($this->conn->lastInsertId());
    }

    public function updateCar(Car $car) {
        $stmt = $this->conn->prepare("UPDATE cars SET type = :type, color = :color, `condition` = :condition WHERE id = :id");
        $stmt->bindParam(':type', $car->getType());
        $stmt->bindParam(':color', $car->getColor());
        $stmt->bindParam(':condition', $car->getCondition());
        $stmt->bindParam(':id', $car->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteCar($id) {
        $stmt = $this->conn->prepare("DELETE FROM cars WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
