<?php
require_once 'MySQLCarDAO.php';

// Database configuration
$host = 'localhost';
$dbname = 'car_rental';
$username = 'your_username';
$password = 'your_password';

// Create an instance of MySQLCarDAO
$carDAO = new MySQLCarDAO($host, $dbname, $username, $password);

// Add a new car
$newCar = new Car(null, 'Sedan', 'Blue', 'New');
$carDAO->addCar($newCar);
echo "Added a new car.\n";

// Retrieve and display all cars
$cars = $carDAO->getAllCars();
foreach ($cars as $car) {
    echo "ID: " . $car->getId() . " | Type: " . $car->getType() . " | Color: " . $car->getColor() . " | Condition: " . $car->getCondition() . "\n";
}

// Update a car (assuming a car with id=1 exists)
$car = $carDAO->getCarById(1);
if ($car !== null) {
    $car->setColor('Red');
    $carDAO->updateCar($car);
    echo "Updated car with ID 1.\n";
}

// Delete a car (assuming a car with id=2 exists)
$carDAO->deleteCar(2);
echo "Deleted car with ID 2.\n";
?>
