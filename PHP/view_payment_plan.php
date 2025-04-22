<?php
$conn = new mysqli("localhost", "root", "", "rar_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['payment_id'])) {
  die("Payment ID not provided.");
}

$payment_id = (int)$_GET['payment_id'];

// Get payment details with car info
$sql = "SELECT p.*, c.make, c.model, c.year
        FROM payments p
        JOIN cars c ON p.car_id = c.id
        WHERE p.id = $payment_id";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
  die("Payment not found.");
}

$payment = $result->fetch_assoc();

// Get payment plan
$plans = $conn->query("SELECT * FROM payment_plans WHERE payment_id = $payment_id ORDER BY month_number ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Plan</title>
  <link rel="stylesheet" href="../CSS/payment.css"> <!-- reuse your payment CSS -->
  <style>
    .plan-table {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;
    }
    .plan-table th, .plan-table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    .status-paid {
      color: green;
      font-weight: bold;
    }
    .status-pending {
      color: orange;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="payment-container">
    <h2>Payment Plan for <?= htmlspecialchars($payment['customer_name']) ?></h2>
    <p><strong>Car:</strong> <?= $payment['make'] . ' ' . $payment['model'] . ' (' . $payment['year'] . ')' ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($payment['email']) ?></p>
    <p><strong>Payment Type:</strong> <?= ucfirst($payment['payment_type']) ?></p>

    <?php if ($payment['payment_type'] === 'installment' && $plans->num_rows > 0): ?>
      <h3>3-Month Installment Plan</h3>
      <table class="plan-table">
        <tr>
          <th>Month</th>
          <th>Amount</th>
          <th>Due Date</th>
          <th>Status</th>
        </tr>
        <?php while ($plan = $plans->fetch_assoc()): ?>
          <tr>
            <td><?= $plan['month_number'] ?></td>
            <td>$<?= number_format($plan['amount'], 2) ?></td>
            <td><?= $plan['due_date'] ?></td>
            <td class="status-<?= $plan['status'] ?>">
                <?php if ($plan['status'] == 'pending'): ?>
                    <form action="pay_installment.php" method="POST" style="display:inline;">
                        <input type="hidden" name="plan_id" value="<?= $plan['id'] ?>">
                        <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                        <button type="submit">Pay Now</button>
                    </form>
                <?php else: ?>
                    Paid
                <?php endif; ?>
            </td>

          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>This payment was made in full. No installment plan available.</p>
    <?php endif; ?>
  </div>
</body>
</html>
