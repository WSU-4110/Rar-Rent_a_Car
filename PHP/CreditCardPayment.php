<?php
require_once 'PaymentStrategy.php';

class CreditCardPayment implements PaymentStrategy {
    private $cardNumber;
    
    public function __construct($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    public function pay($amount) {
        echo "Paid $$amount using Credit Card ending in " . substr($this->cardNumber, -4);
    }
}
?>