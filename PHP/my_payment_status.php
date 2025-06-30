<?php
$conn = new mysqli("rardb.c9g0iygiccbe.us-east-2.rds.amazonaws.com", "root", "Poiuytre123*", "rardb");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// ✅ Use the logged-in user's email
$customer_email = $_SESSION['email'] ?? null;

echo "<div class='payment-status-box'>";

if ($customer_email) {
  $result = $conn->query("SELECT * FROM payments WHERE email = '$customer_email' LIMIT 1");
  if ($result && $result->num_rows > 0) {
    $payment = $result->fetch_assoc();
    echo "<p>You have an active payment for Car ID: {$payment['car_id']}</p>";
    echo "<a href='./PHP/view_payment_plan.php?payment_id={$payment['id']}' class='payment-button'>View My Payment & Plan</a>";
  } else {
    echo "<p>You do not have a current payment or plan to view.</p>";
  }
} else {
  echo "<p>Please log in to view your payment status.</p>";
}

echo "</div>";

$conn->close();
?>
