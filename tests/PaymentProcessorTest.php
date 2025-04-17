<?php
use PHPUnit\Framework\TestCase;
require_once 'PaymentProcessor.php';

class PaymentProcessorTest extends TestCase
{
    public function testConstructorStoresPaymentStrategy()
    {
        // Create a mock payment strategy
        $mockStrategy = $this->createMock(PaymentStrategy::class);

        $processor = new PaymentProcessor($mockStrategy);

        // Use reflection to access the private property
        $reflection = new ReflectionClass($processor);
        $property = $reflection->getProperty('paymentStrategy');
        $property->setAccessible(true);

        $this->assertSame($mockStrategy, $property->getValue($processor));
    }

    public function testProcessPaymentCallsStrategyPay()
    {
        $mockStrategy = $this->createMock(PaymentStrategy::class);

        // Expect 'pay' to be called once with amount 100
        $mockStrategy->expects($this->once())
                     ->method('pay')
                     ->with(100);

        $processor = new PaymentProcessor($mockStrategy);
        $processor->processPayment(100); // This should trigger the 'pay' method
    }
}