import random
import string
import datetime
from abc import ABC, abstractmethod

# Car data constants
COLORS = [
    "Black", "White", "Silver", "Gray", "Blue", "Red", "Green", 
    "Brown", "Yellow", "Orange", "Purple", "Burgundy"
]

FUEL_TYPES = [
    "Gasoline", "Diesel", "Hybrid", "Electric", "Plug-in Hybrid"
]

CONDITIONS = [
    "Excellent", "Very Good", "Good", "Fair"
]

STATES = [
    "MI", "CA", "TX", "FL", "NY", "OH", "IL", "PA", "GA", "NC"
]

# Car interface
class Car:
    def __init__(self, make, model, year, color):
        self.make = make
        self.model = model
        self.year = year
        self.color = color
        self.condition = random.choice(CONDITIONS)
        self.plate_number = self._generate_plate()
        self.mileage = self._calculate_mileage(year)
        self.image_url = f"images/cars/{make.lower()}-{model.lower().replace(' ', '-')}-{year}-{color.lower()}.jpg"
        
    def _generate_plate(self):
        state = random.choice(STATES)
        letters = ''.join(random.choices(string.ascii_uppercase, k=3))
        numbers = ''.join(random.choices(string.digits, k=3))
        return f"{state}-{letters}{numbers}"
        
    def _calculate_mileage(self, year):
        current_year = datetime.datetime.now().year
        age = current_year - year
        base_mileage = 12000  # Average miles per year
        mileage = random.randint(base_mileage * (age - 1), base_mileage * (age + 1))
        return max(mileage, 500)  # Minimum 500 miles
    
    def get_details(self):
        return {
            "make": self.make,
            "model": self.model,
            "year": self.year,
            "color": self.color,
            "condition": self.condition,
            "plate_number": self.plate_number,
            "mileage": self.mileage,
            "fuel_type": self.get_fuel_type(),
            "rental_price_per_day": self.get_daily_rate(),
            "rental_price_per_week": self.get_weekly_rate(),
            "availability_status": self.get_availability_status(),
            "hot_type": self.get_category(),
            "image_url": self.image_url
        }
    
    @abstractmethod
    def get_category(self):
        pass
        
    @abstractmethod
    def get_fuel_type(self):
        pass
        
    @abstractmethod
    def get_daily_rate(self):
        pass
        
    def get_weekly_rate(self):
        # Default weekly rate is daily rate * 6 (7 days for price of 6)
        return round(self.get_daily_rate() * 6, 2)
        
    def get_availability_status(self):
        # 70% chance available, 30% other status
        return random.choices(
            ['available', 'rented', 'maintenance', 'reserved'],
            weights=[70, 15, 10, 5],
            k=1
        )[0]

# Concrete car classes
class EconomyCar(Car):
    def get_category(self):
        return "economy"
        
    def get_fuel_type(self):
        # Economy cars are usually gasoline or hybrid
        return random.choices(FUEL_TYPES[:3], weights=[80, 5, 15, 0, 0], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(35, 45)
        # Adjust for condition and year
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.95 ** (current_year - self.year)
        
        return round(base_rate * condition_factor * year_factor, 2)

class CompactCar(Car):
    def get_category(self):
        return "compact"
        
    def get_fuel_type(self):
        # Compact cars are usually gasoline
        return random.choices(FUEL_TYPES, weights=[85, 5, 10, 0, 0], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(40, 50)
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.95 ** (current_year - self.year)
        
        return round(base_rate * condition_factor * year_factor, 2)

class MidsizeCar(Car):
    def get_category(self):
        return "mid-size"
        
    def get_fuel_type(self):
        return random.choices(FUEL_TYPES, weights=[75, 5, 15, 5, 0], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(50, 65)
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.95 ** (current_year - self.year)
        
        return round(base_rate * condition_factor * year_factor, 2)

class LuxuryCar(Car):
    def get_category(self):
        return "luxury"
        
    def get_fuel_type(self):
        return random.choices(FUEL_TYPES, weights=[65, 5, 15, 10, 5], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(80, 150)
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.97 ** (current_year - self.year)  # Luxury cars depreciate slower
        
        return round(base_rate * condition_factor * year_factor, 2)

class SUV(Car):
    def get_category(self):
        return "suv"
        
    def get_fuel_type(self):
        return random.choices(FUEL_TYPES, weights=[70, 15, 10, 5, 0], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(60, 90)
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.94 ** (current_year - self.year)
        
        return round(base_rate * condition_factor * year_factor, 2)

class Van(Car):
    def get_category(self):
        return "van"
        
    def get_fuel_type(self):
        return random.choices(FUEL_TYPES, weights=[75, 15, 10, 0, 0], k=1)[0]
        
    def get_daily_rate(self):
        base_rate = random.uniform(70, 90)
        condition_factor = {
            "Excellent": 1.1,
            "Very Good": 1.0,
            "Good": 0.9,
            "Fair": 0.8
        }[self.condition]
        
        current_year = datetime.datetime.now().year
        year_factor = 0.94 ** (current_year - self.year)
        
        return round(base_rate * condition_factor * year_factor, 2)

# Abstract Factory
class CarFactory(ABC):
    @abstractmethod
    def create_car(self):
        pass

# Concrete Factories
class EconomyCarFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "Toyota": ["Corolla", "Yaris"],
            "Honda": ["Civic", "Fit"],
            "Nissan": ["Sentra", "Versa"],
            "Hyundai": ["Elantra", "Accent"],
            "Kia": ["Forte", "Rio"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2015, datetime.datetime.now().year)
        color = random.choice(COLORS)
        
        return EconomyCar(make, model, year, color)

class CompactCarFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "Mazda": ["Mazda3"],
            "Volkswagen": ["Golf", "Jetta"],
            "Subaru": ["Impreza"],
            "Ford": ["Focus"],
            "Chevrolet": ["Cruze"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2015, datetime.datetime.now().year)
        color = random.choice(COLORS)
        
        return CompactCar(make, model, year, color)

class MidsizeCarFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "Toyota": ["Camry"],
            "Honda": ["Accord"],
            "Nissan": ["Altima"],
            "Hyundai": ["Sonata"],
            "Kia": ["K5", "Optima"],
            "Ford": ["Fusion"],
            "Chevrolet": ["Malibu"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2015, datetime.datetime.now().year)
        color = random.choice(COLORS)
        
        return MidsizeCar(make, model, year, color)

class LuxuryCarFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "BMW": ["3 Series", "5 Series", "7 Series"],
            "Mercedes-Benz": ["C-Class", "E-Class", "S-Class"],
            "Audi": ["A4", "A6", "A8"],
            "Lexus": ["ES", "GS", "LS"],
            "Tesla": ["Model 3", "Model S"],
            "Porsche": ["Panamera"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2018, datetime.datetime.now().year)  # Luxury cars tend to be newer
        color = random.choice(COLORS)
        
        return LuxuryCar(make, model, year, color)

class SUVFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "Toyota": ["RAV4", "Highlander", "4Runner"],
            "Honda": ["CR-V", "Pilot", "Passport"],
            "Ford": ["Escape", "Explorer", "Edge"],
            "Chevrolet": ["Equinox", "Traverse", "Tahoe"],
            "Jeep": ["Cherokee", "Grand Cherokee", "Wrangler"],
            "Nissan": ["Rogue", "Murano", "Pathfinder"],
            "BMW": ["X3", "X5", "X7"],
            "Mercedes-Benz": ["GLC", "GLE", "GLS"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2015, datetime.datetime.now().year)
        color = random.choice(COLORS)
        
        return SUV(make, model, year, color)

class VanFactory(CarFactory):
    def __init__(self):
        self.makes_models = {
            "Honda": ["Odyssey"],
            "Toyota": ["Sienna"],
            "Chrysler": ["Pacifica"],
            "Kia": ["Carnival", "Sedona"],
            "Dodge": ["Grand Caravan"]
        }
    
    def create_car(self):
        make = random.choice(list(self.makes_models.keys()))
        model = random.choice(self.makes_models[make])
        year = random.randint(2015, datetime.datetime.now().year)
        color = random.choice(COLORS)
        
        return Van(make, model, year, color)

# Client code
class CarGenerator:
    def __init__(self):
        self.factories = {
            "economy": EconomyCarFactory(),
            "compact": CompactCarFactory(),
            "mid-size": MidsizeCarFactory(),
            "luxury": LuxuryCarFactory(),
            "suv": SUVFactory(),
            "van": VanFactory()
        }
    
    def generate_random_car(self):
        # Randomly select a factory with weighted probabilities
        factory_type = random.choices(
            list(self.factories.keys()),
            weights=[30, 20, 20, 10, 15, 5],  # Economy cars are most common
            k=1
        )[0]
        
        factory = self.factories[factory_type]
        return factory.create_car()
    
    def generate_cars(self, count=10):
        cars = []
        for _ in range(count):
            car = self.generate_random_car()
            cars.append(car.get_details())
        return cars
    
    def generate_sql_insert(self, car_data):
        """Generate SQL INSERT statement for the car data"""
        columns = ', '.join(car_data.keys())
        placeholders = ', '.join([f"'{value}'" if isinstance(value, str) else str(value) for value in car_data.values()])
        return f"INSERT INTO cars ({columns}) VALUES ({placeholders});"

# Example usage
if __name__ == "__main__":
    generator = CarGenerator()
    
    # Generate 5 random cars
    cars = generator.generate_cars(5)
    
    # Print cars as formatted data
    print(f"Generated 5 random cars:\n")
    
    for i, car in enumerate(cars, 1):
        print(f"Car #{i}:")
        for key, value in car.items():
            print(f"  {key}: {value}")
        print()
    
    # Generate and print SQL insert statements
    print("\nSQL INSERT statements:")
    for car in cars:
        print(generator.generate_sql_insert(car))
        print()
