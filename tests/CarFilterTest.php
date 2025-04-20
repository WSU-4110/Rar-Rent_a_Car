<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/CarFilter.php';

class CarFilterTest extends TestCase {
    public function testNoFiltersReturnsAllCars() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        $result->expects($this->exactly(2))
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['id' => 1, 'make' => 'Toyota'],
                   null
               );
        $conn->method('query')
             ->with("SELECT * FROM cars WHERE 1=1")
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars([]);

        $this->assertCount(1, $cars);
        $this->assertEquals('Toyota', $cars[0]['make']);
    }

    public function testFilterByMakeReturnsSpecificCars() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        $result->expects($this->exactly(2))
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['id' => 2, 'make' => 'Honda'],
                   null
               );
        $expectedSql = "SELECT * FROM cars WHERE 1=1 AND `make` = 'Honda'";
        $conn->method('query')
             ->with($expectedSql)
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars(['make' => 'Honda']);

        $this->assertCount(1, $cars);
        $this->assertEquals('Honda', $cars[0]['make']);
    }

    public function testFilterByRentalPricePerDay() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        $result->expects($this->exactly(2))
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['id' => 3, 'rental_price_per_day' => 40],
                   null
               );
        $expectedSql = "SELECT * FROM cars WHERE 1=1 AND `rental_price_per_day` <= '50'";
        $conn->method('query')
             ->with($expectedSql)
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars(['rental_price_per_day' => 50]);

        $this->assertCount(1, $cars);
        $this->assertEquals(40, $cars[0]['rental_price_per_day']);
    }

    public function testFilterByAvailabilityStatus() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        $result->expects($this->exactly(2))
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['id' => 4, 'availability_status' => 'available'],
                   null
               );
        $expectedSql = "SELECT * FROM cars WHERE 1=1 AND `availability_status` = 'available'";
        $conn->method('query')
             ->with($expectedSql)
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars(['availability_status' => 'available']);

        $this->assertCount(1, $cars);
        $this->assertEquals('available', $cars[0]['availability_status']);
    }

    public function testFilterByMakeAndYear() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        $result->expects($this->exactly(2))
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls(
                   ['id' => 5, 'make' => 'Tesla', 'year' => 2022],
                   null
               );
        $expectedSql = "SELECT * FROM cars WHERE 1=1 AND `make` = 'Tesla' AND `year` = '2022'";
        $conn->method('query')
             ->with($expectedSql)
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars(['make' => 'Tesla', 'year' => 2022]);

        $this->assertCount(1, $cars);
        $this->assertEquals('Tesla', $cars[0]['make']);
        $this->assertEquals(2022, $cars[0]['year']);
    }

    public function testNoMatchingResultsReturnsEmptyArray() {
        $conn = $this->createMock(mysqli::class);
        $conn->method('real_escape_string')->willReturnArgument(0);
        $result = $this->createMock(mysqli_result::class);

        // Stub fetch_assoc to return null immediately (no rows)
        $result->expects($this->once())
               ->method('fetch_assoc')
               ->willReturn(null);

        $expectedSql = "SELECT * FROM cars WHERE 1=1 AND `make` = 'Unknown'";
        $conn->method('query')
             ->with($expectedSql)
             ->willReturn($result);

        $filter = new CarFilter($conn);
        $cars = $filter->getFilteredCars(['make' => 'Unknown']);

        $this->assertEmpty($cars);
    }
}
