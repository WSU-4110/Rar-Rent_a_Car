<?php
require_once 'CreditCardPayment.php';
require_once 'PayPalPayment.php';
require_once 'PaymentProcessor.php';

// Get user selection
$paymentMethod = $_POST['payment_method'];
$amount = $_POST['amount'];

if ($paymentMethod == 'credit_card') {
    $payment = new CreditCardPayment($_POST['card_number']);
} elseif ($paymentMethod == 'paypal') {
    $payment = new PayPalPayment($_POST['paypal_email']);
} else {
    die("Invalid payment method selected.");
}

$processor = new PaymentProcessor($payment);
$processor->processPayment($amount);
?>