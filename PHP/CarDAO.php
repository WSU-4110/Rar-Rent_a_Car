<?php
interface CarDAO {
    public function getCarById($id);
    public function getAllCars();
    public function addCar(Car $car);
    public function updateCar(Car $car);
    public function deleteCar($id);
}
?>
