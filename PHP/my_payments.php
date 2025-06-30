<?php
$conn = new mysqli("rardb.c9g0iygiccbe.us-east-2.rds.amazonaws.com", "root", "Poiuytre123*", "rardb");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get all payments (optional: filter by user_id if needed)
$sql = "SELECT payments.id AS payment_id, cars.make, cars.model, cars.year 
        FROM payments 
        JOIN cars ON payments.car_id = cars.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Payments</title>
  <style>
    .payment-card {
      border: 1px solid #ccc;
      padding: 12px;
      margin: 12px 0;
      border-radius: 6px;
    }
    .cancel-btn {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h2>My Payments</h2>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="payment-card">
        <p><strong>Car:</strong> <?= $row['make'] ?> <?= $row['model'] ?> (<?= $row['year'] ?>)</p>
        <a class="cancel-btn" 
           href="cancel_payment.php?payment_id=<?= $row['payment_id'] ?>" 
           onclick="return confirm('Are you sure you want to cancel this payment?');">
          Cancel Payment
        </a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No active payments found.</p>
  <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
