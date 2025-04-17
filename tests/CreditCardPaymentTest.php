<?php
use PHPUnit\Framework\TestCase;

// Adjust this path depending on where CreditCardPayment.php is
require_once './CreditCardPayment.php';

class CreditCardPaymentTest extends TestCase {

    public function testPayOutputsCorrectMessage() {
        $cardNumber = '1234567812345678';
        $amount = 50;

        // Start output buffering to capture echo
        ob_start();
        $payment = new CreditCardPayment($cardNumber);
        $payment->pay($amount);
        $output = ob_get_clean();

        $expected = "Paid \$50 using Credit Card ending in 5678";
        $this->assertEquals($expected, $output);
    }
}