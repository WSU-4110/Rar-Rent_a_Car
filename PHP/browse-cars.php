<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Filter</title>
  <link rel="stylesheet" href="../CSS/browse-cars.css">
</head>
<body>
  <h2 class="title">Filter Available Cars</h2>

  <form method="GET" action="">
    <div class="filter-container">
      <select name="make">
        <option value="">Make</option>
        <option value="Toyota">Toyota</option>
        <option value="Honda">Honda</option>
        <option value="Nissan">Nissan</option>
        <option value="Hyundai">Hyundai</option>
        <option value="Kia">Kia</option>
        <option value="Mazda">Mazda</option>
        <option value="Volkswagen">Volkswagen</option>
        <option value="Subaru">Subaru</option>
        <option value="Ford">Ford</option>
        <option value="Chevrolet">Chevrolet</option>
        <option value="BMW">BMW</option>
        <option value="Mercedes-Benz">Mercedes-Benz</option>
        <option value="Audi">Audi</option>
        <option value="Lexus">Lexus</option>
        <option value="Tesla">Tesla</option>
        <option value="Porsche">Porsche</option>
        <option value="Jeep">Jeep</option>
        <option value="Chrysler">Chrysler</option>
        <option value="Dodge">Dodge</option>
      </select>

      <select name="model">
        <option value="">Model</option>
        <option value="Corolla">Corolla</option>
        <option value="Yaris">Yaris</option>
        <option value="Civic">Civic</option>
        <option value="Fit">Fit</option>
        <option value="Sentra">Sentra</option>
        <option value="Versa">Versa</option>
        <option value="Elantra">Elantra</option>
        <option value="Accent">Accent</option>
        <option value="Forte">Forte</option>
        <option value="Rio">Rio</option>
        <option value="Mazda3">Mazda3</option>
        <option value="Golf">Golf</option>
        <option value="Jetta">Jetta</option>
        <option value="Impreza">Impreza</option>
        <option value="Focus">Focus</option>
        <option value="Cruze">Cruze</option>
        <option value="Camry">Camry</option>
        <option value="Accord">Accord</option>
        <option value="Altima">Altima</option>
        <option value="Sonata">Sonata</option>
        <option value="K5">K5</option>
        <option value="Optima">Optima</option>
        <option value="Fusion">Fusion</option>
        <option value="Malibu">Malibu</option>
        <option value="3 Series">3 Series</option>
        <option value="5 Series">5 Series</option>
        <option value="7 Series">7 Series</option>
        <option value="C-Class">C-Class</option>
        <option value="E-Class">E-Class</option>
        <option value="S-Class">S-Class</option>
        <option value="A4">A4</option>
        <option value="A6">A6</option>
        <option value="A8">A8</option>
        <option value="ES">ES</option>
        <option value="GS">GS</option>
        <option value="LS">LS</option>
        <option value="Model 3">Model 3</option>
        <option value="Model S">Model S</option>
        <option value="Panamera">Panamera</option>
        <option value="RAV4">RAV4</option>
        <option value="Highlander">Highlander</option>
        <option value="4Runner">4Runner</option>
        <option value="CR-V">CR-V</option>
        <option value="Pilot">Pilot</option>
        <option value="Passport">Passport</option>
        <option value="Escape">Escape</option>
        <option value="Explorer">Explorer</option>
        <option value="Edge">Edge</option>
        <option value="Equinox">Equinox</option>
        <option value="Traverse">Traverse</option>
        <option value="Tahoe">Tahoe</option>
        <option value="Cherokee">Cherokee</option>
        <option value="Grand Cherokee">Grand Cherokee</option>
        <option value="Wrangler">Wrangler</option>
        <option value="X3">X3</option>
        <option value="X5">X5</option>
        <option value="X7">X7</option>
        <option value="GLC">GLC</option>
        <option value="GLE">GLE</option>
        <option value="GLS">GLS</option>
        <option value="Odyssey">Odyssey</option>
        <option value="Sienna">Sienna</option>
        <option value="Pacifica">Pacifica</option>
        <option value="Carnival">Carnival</option>
        <option value="Sedona">Sedona</option>
        <option value="Grand Caravan">Grand Caravan</option>
      </select>

      <select name="year" id="year">
        <option value="">Year</option>
        <script>
          for (let y = 2001; y <= 2025; y++) {
            document.write(`<option value="${y}">${y}</option>`);
          }
        </script>
      </select>

      <select name="color">
        <option value="">Color</option>
        <option>Black</option>
        <option>White</option>
        <option>Silver</option>
        <option>Gray</option>
        <option>Blue</option>
        <option>Red</option>
        <option>Green</option>
        <option>Brown</option>
        <option>Yellow</option>
        <option>Orange</option>
        <option>Purple</option>
        <option>Burgundy</option>
      </select>

      <select name="condition">
        <option value="">Condition</option>
        <option>Excellent</option>
        <option>Very Good</option>
        <option>Good</option>
        <option>Fair</option>
      </select>

      <select name="fuel_type">
        <option value="">Fuel Type</option>
        <option>Gasoline</option>
        <option>Diesel</option>
        <option>Hybrid</option>
        <option>Electric</option>
        <option>Plug-in Hybrid</option>
      </select>

      <input type="number" name="rental_price_per_day" placeholder="Max Price/Day">

      <select name="availability_status">
        <option value="">Availability</option>
        <option value="available">Available</option>
        <option value="rented">Rented</option>
        <option value="reserved">Reserved</option>
      </select>

      <button type="submit">Filter</button>
    </div>
  </form>

  <div class="results">
    <?php include 'fetch_cars.php'; ?>
  </div>

</body>
</html>
