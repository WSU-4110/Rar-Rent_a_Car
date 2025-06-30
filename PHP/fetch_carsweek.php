<?php
$conn = new mysqli("rardb.c9g0iygiccbe.us-east-2.rds.amazonaws.com", "root", "Poiuytre123*", "rardb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cars WHERE 1=1";

$filters = [
  'make', 'model', 'year', 'color', 'condition',
  'plate_number', 'mileage', 'fuel_type',
  'rental_price_per_day', 'rental_price_per_week',
  'availability_status', 'hot_type'
];

foreach ($filters as $field) {
  if (!empty($_GET[$field])) {
    $value = $conn->real_escape_string($_GET[$field]);
    if (in_array($field, ['mileage', 'rental_price_per_day', 'rental_price_per_week'])) {
      $sql .= " AND `$field` <= '$value'";
    } else {
      $sql .= " AND `$field` = '$value'";
    }    
  }
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($car = $result->fetch_assoc()) {
    echo "<div class='car-card'>
      <img src='../logoimages/redcar.jpg' alt='Car Image'>
      <div class='info'>
        <h3>{$car['make']} {$car['model']} ({$car['year']})</h3>
        <p>Color: {$car['color']}</p>
        <p>Condition: {$car['condition']}</p>
        <p>Mileage: {$car['mileage']} mi</p>
        <p>Fuel: {$car['fuel_type']}</p>
        <p>Price/Week: $ {$car['rental_price_per_week']}</p>
        <p>Status: <strong>" . ucfirst($car['availability_status']) . "</strong></p>";

    if ($car['availability_status'] === 'available') {
      echo "<form action='payment.php' method='GET'>
              <input type='hidden' name='car_id' value='{$car['id']}'>
              <button type='submit' class='rent-button'>Rent This Car</button>
            </form>";
    } else {
      echo "<p class='unavailable'>This car is not available.</p>";
    }

    echo "</div></div>";
  }
} else {
  echo "<p>No cars match the selected filters.</p>";
}

$conn->close();
?>
