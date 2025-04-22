<?php
$conn = new mysqli("localhost", "root", "", "rar_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['payment_id'])) {
  die("Payment ID is required.");
}

$payment_id = intval($_GET['payment_id']);

// Get car ID related to the payment
$result = $conn->query("SELECT car_id FROM payments WHERE id = $payment_id");

if ($result && $result->num_rows > 0) {
  $car_id = $result->fetch_assoc()['car_id'];

  // Delete payment
  $conn->query("DELETE FROM payments WHERE id = $payment_id");

  // Delete payment plan
  $conn->query("DELETE FROM payment_plans WHERE payment_id = $payment_id");

  // Update car status to 'available'
  $conn->query("UPDATE cars SET availability_status = 'available' WHERE id = $car_id");

  echo "<p>✅ Payment canceled and car is now available again.</p>";
  echo "<a href='my_payments.php'>Back to Payments</a>";

} else {
  echo "❌ Payment not found.";
}

$conn->close();
?>
