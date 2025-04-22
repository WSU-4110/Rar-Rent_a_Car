<?php

class CarFilter {
    private $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function getFilteredCars(array $params): array {
        $sql = "SELECT * FROM cars WHERE 1=1";
        $filters = ['make', 'model', 'year', 'color', 'condition', 'plate_number', 'mileage', 'fuel_type', 'rental_price_per_day', 'rental_price_per_week', 'availability_status', 'hot_type'];

        foreach ($filters as $field) {
            if (!empty($params[$field])) {
                $value = $this->conn->real_escape_string($params[$field]);
                if (in_array($field, ['mileage', 'rental_price_per_day', 'rental_price_per_week'])) {
                    $sql .= " AND `$field` <= '$value'";
                } else {
                    $sql .= " AND `$field` = '$value'";
                }
            }
        }

        $result = $this->conn->query($sql);
        $cars = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
        }        

        return $cars;
    }
}
