<?php

use PHPUnit\Framework\TestCase;
require_once 'PayPalPayment.php';

class PayPalPaymentTest extends TestCase
{
    public function testConstructorStoresEmail()
    {
        $email = 'test@example.com';
        $payment = new PayPalPayment($email);

        $reflection = new ReflectionClass($payment);
        $property = $reflection->getProperty('email');
        $property->setAccessible(true);

        $this->assertEquals($email, $property->getValue($payment));
    }

    public function testPayOutputsCorrectMessage()
    {
        $email = 'test@example.com';
        $amount = 25;

        ob_start(); // Start output buffering
        $payment = new PayPalPayment($email);
        $payment->pay($amount);
        $output = ob_get_clean(); // Get output and clean buffer

        $expected = "Paid \$25 using PayPal with email: $email";
        $this->assertEquals($expected, $output);
    }
}