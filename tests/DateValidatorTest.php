<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Helper.php';

class DateValidatorTest extends TestCase
{
    public function testIsValidDateRange()
    {
        $this->assertTrue(DateValidator::isValidDateRange('2025-04-20', '2025-04-21'));
        $this->assertFalse(DateValidator::isValidDateRange('2025-04-21', '2025-04-20'));
    }
}