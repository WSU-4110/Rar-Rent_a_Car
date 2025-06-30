<?php
$conn = new mysqli("rardb.c9g0iygiccbe.us-east-2.rds.amazonaws.com", "root", "Poiuytre123*", "rardb");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['car_id'])) {
  die("Car ID not provided.");
}

$car_id = (int)$_GET['car_id'];
$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
  die("Car not found.");
}

$car = $result->fetch_assoc();

if ($car['availability_status'] !== 'available') {
  die("Sorry, this car is currently {$car['availability_status']} and cannot be rented.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Rent Car</title>
  <link rel="stylesheet" href="../CSS/payment.css" />
</head>
<body>
  <div class="payment-container">
    <h2>Rent <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?> (<?= htmlspecialchars($car['year']) ?>)</h2>
    <form action="process_payment.php" method="POST">
      <input type="hidden" name="car_id" value="<?= $car['id'] ?>" />
      <label>Your Name</label>
      <input type="text" name="customer_name" required />
      <label>Email</label>
      <input type="email" name="email" required />
      <label>Card Number</label>
      <input type="text" name="card_number" required />
      <label>Payment Type</label>
      <select name="payment_type" required>
        <option value="full">Full Payment</option>
        <option value="installment">3-Month Plan</option>
      </select>
      <button type="submit">Pay & Rent</button>
    </form>
  </div>
</body>
</html>
