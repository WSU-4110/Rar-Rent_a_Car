<?php
$conn = new mysqli("localhost", "root", "", "rar_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['plan_id']) || !isset($_POST['payment_id'])) {
  die("Missing payment information.");
}

$plan_id = (int)$_POST['plan_id'];
$payment_id = (int)$_POST['payment_id'];

// Update status to 'paid'
$conn->query("UPDATE payment_plans SET status = 'paid' WHERE id = $plan_id");

// Redirect back
header("Location: view_payment_plan.php?payment_id=$payment_id");
exit();
?>
