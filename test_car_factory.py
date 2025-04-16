import unittest

class Car:
    def __init__(self, make, model, year, price_per_day):
        self.make = make
        self.model = model
        self.year = year
        self.price_per_day = price_per_day

    def get_description(self):
        return f"{self.year} {self.make} {self.model}"

    def get_price(self):
        return self.price_per_day


class LuxuryCar(Car):
    def __init__(self):
        super().__init__("Mercedes", "S-Class", 2023, 150)


class EconomyCar(Car):
    def __init__(self):
        super().__init__("Toyota", "Corolla", 2021, 40)


class CarFactory:
    def create_car(self, car_type):
        if car_type == "luxury":
            return LuxuryCar()
        elif car_type == "economy":
            return EconomyCar()
        else:
            raise ValueError("Unknown car type")

class TestCarFactory(unittest.TestCase):

    def test_create_luxury_car(self):
        factory = CarFactory()
        car = factory.create_car("luxury")
        self.assertIsInstance(car, LuxuryCar)
        self.assertEqual(car.make, "Mercedes")
        self.assertEqual(car.get_price(), 150)

    def test_create_economy_car(self):
        factory = CarFactory()
        car = factory.create_car("economy")
        self.assertIsInstance(car, EconomyCar)
        self.assertEqual(car.model, "Corolla")
        self.assertEqual(car.get_price(), 40)

    def test_invalid_car_type_raises_exception(self):
        factory = CarFactory()
        with self.assertRaises(ValueError):
            factory.create_car("sports")

    def test_luxury_car_description(self):
        car = LuxuryCar()
        desc = car.get_description()
        self.assertEqual(desc, "2023 Mercedes S-Class")

    def test_economy_car_description(self):
        car = EconomyCar()
        desc = car.get_description()
        self.assertEqual(desc, "2021 Toyota Corolla")

    def test_price_consistency(self):
        luxury = LuxuryCar()
        economy = EconomyCar()
        self.assertGreater(luxury.get_price(), economy.get_price())

if __name__ == "__main__":
    unittest.main()