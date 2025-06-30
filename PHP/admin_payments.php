<?php
$conn = new mysqli("localhost", "root", "", "rar_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// --- Cancel logic ---
if (isset($_GET['payment_id'])) {
  $payment_id = intval($_GET['payment_id']);

  // Find car ID
  $result = $conn->query("SELECT car_id FROM payments WHERE id = $payment_id");
  if ($result && $result->num_rows > 0) {
    $car_id = $result->fetch_assoc()['car_id'];

    // Delete payment
    $conn->query("DELETE FROM payments WHERE id = $payment_id");

    // Delete plan
    $conn->query("DELETE FROM payment_plans WHERE payment_id = $payment_id");

    // Make car available again
    $conn->query("UPDATE cars SET availability_status = 'available' WHERE id = $car_id");

    echo "<p style='color: green;'>✅ Payment canceled and car is now available again.</p>";
    echo "<a href='admin_payments.php'>Back to Payments</a>";

    $conn->close();
    exit;
  } else {
    echo "<p style='color: red;'>❌ Payment not found.</p>";
    echo "<a href='admin_payments.php'>Back to Payments</a>";
    $conn->close();
    exit;
  }
}

// --- Otherwise: show all payments ---
$result = $conn->query("SELECT * FROM payments");

echo "<h2>Admin - All Payments</h2>";

if ($result->num_rows > 0) {
  echo "<table border='1' cellpadding='5'>
    <tr>
      <th>ID</th>
      <th>Car ID</th>
      <th>Customer</th>
      <th>Email</th>
      <th>Type</th>
      <th>Date</th>
      <th>Action</th>
    </tr>";

  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>{$row['id']}</td>
      <td>{$row['car_id']}</td>
      <td>{$row['customer_name']}</td>
      <td>{$row['email']}</td>
      <td>{$row['payment_type']}</td>
      <td>{$row['payment_date']}</td>
      <td>
        <a href='admin_payments.php?payment_id={$row['id']}'
           onclick=\"return confirm('Are you sure you want to cancel this payment?');\">
           Cancel
        </a>
      </td>
    </tr>";
  }

  echo "</table>";
} else {
  echo "No payments found.";
}

$conn->close();
?>
