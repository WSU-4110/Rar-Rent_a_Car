<?php
$conn = new mysqli("localhost", "root", "", "rar_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$car_id = $_POST['car_id'];
$name = $conn->real_escape_string($_POST['customer_name']);
$email = $conn->real_escape_string($_POST['email']);
$card = $conn->real_escape_string($_POST['card_number']);
$payment_type = $_POST['payment_type'];

// Insert into payments table
$conn->query("INSERT INTO payments (car_id, customer_name, email, card_number, payment_type)
              VALUES ('$car_id', '$name', '$email', '$card', '$payment_type')");

$payment_id = $conn->insert_id;

// If installment plan, create 3 entries
if ($payment_type == 'installment') {
    // Get car price from the database
    $car_result = $conn->query("SELECT rental_price_per_week FROM cars WHERE id = $car_id");
    $car = $car_result->fetch_assoc();
    $full_price = $car['rental_price_per_week'];
    $amount = round($full_price / 3, 2); // divide into 3 and round to 2 decimal places

  $today = date('Y-m-d');
  for ($i = 1; $i <= 3; $i++) {
    $due_date = date('Y-m-d', strtotime("+$i month", strtotime($today)));
    $conn->query("INSERT INTO payment_plans (payment_id, month_number, amount, due_date)
                  VALUES ('$payment_id', '$i', '$amount', '$due_date')");
  }
}
// Update car status
$new_status = ($payment_type == 'full') ? 'rented' : 'reserved';
$conn->query("UPDATE cars SET availability_status = '$new_status' WHERE id = $car_id");

echo "<p>Payment processed successfully. <a href='view_payment_plan.php?payment_id=$payment_id'>View Payment Plan</a></p>";

?>

