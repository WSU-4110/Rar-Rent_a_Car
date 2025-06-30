<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAR - Home</title>
    <link rel="stylesheet" href="./CSS/home.css">

</head>
<body>
<div class="navbar">
  <!-- Logo always on left -->
  <a href="#hero-image" class="logo">
    <img src="./PHP/Rcarlogo.png" alt="Logo" height="60" />
  </a>

  <!-- Main menu links - desktop only -->
  <div class="menu desktop-only">
    <a href="#hero-image">Home</a>
    <a href="#three-column-section">About Us</a>
    <a href="#browse-cars">Browse Cars</a>
    <a href="#my-payment-section">View Payment</a>
    <a href="./PHP/help.php">Help</a>
    <a href="#meet-the-hosts">Meet the Hosts</a>
    <a href="#contact">Contact Us</a>
  </div>

  <!-- Auth buttons - desktop only -->
  <div class="auth-buttons desktop-only">
    <button onclick="window.location.href='./PHP/signup.php'">Sign Up</button>
    <button onclick="window.location.href='./PHP/login.php'">Log In</button>
  </div>

  <!-- Hamburger Button - visible only on mobile -->
  <div class="hamburger" onclick="toggleSidebar()">☰</div>
</div>

<!-- Sidebar for mobile menu -->
<div class="sidebar" id="sidebar">
  <nav class="sidebar-menu">
    <a href="#hero-image">Home</a>
    <a href="#three-column-section">About Us</a>
    <a href="#browse-cars">Browse Cars</a>
    <a href="#my-payment-section">View Payment</a>
    <a href="./PHP/help.php">Help</a>
    <a href="#meet-the-hosts">Meet the Hosts</a>
    <a href="#contact">Contact Us</a>
    <button onclick="window.location.href='./PHP/signup.php'" class="sidebar-btn">Sign Up</button>
    <button onclick="window.location.href='./PHP/login.php'" class="sidebar-btn">Log In</button>
  </nav>
</div>



    <!-- Background Image Section -->
    <div id="hero-image" class="hero-image">
    <div class="hero-content">
        <h1>Welcome to RAR!</h1>
        <p>Your trusted car rental service with flexible payment plans up to 3 months.</p>
        <!-- Search Section -->
        <div class="search-section">
            <form action="./PHP/dayorweek.php" method="get">
                <label for="where">Where</label>
                <!--<input type="text" id="where" name="where" placeholder="Search for a location" required>-->
                <input type="text" id="where" placeholder="Enter a location" autocomplete="off">
                
                <label for="from">From</label>
                <input type="datetime-local" id="from" name="from" required>
            
                <label for="until">Until</label>
                <input type="datetime-local" id="until" name="until" required>
            
                <button type="submit" class="btn-search">Search</button>

                <div id="map"></div>
                <p id="error-message"></p>

                <script>
                    let map;
                    let autocomplete;
                    let marker;

                    function initMap() {
                    // Create the map container, hidden by default
                        map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 14,
                        });

                        marker = new google.maps.Marker({
                            map: map,
                            visible: false,
                        });

                        // Setup autocomplete
                        const input = document.getElementById("where");
                        autocomplete = new google.maps.places.Autocomplete(input, {
                             types: ["geocode"],
                        });

                        autocomplete.addListener("place_changed", () => {
                            const place = autocomplete.getPlace();
                            const errorMessage = document.getElementById("error-message");

                        if (!place.geometry) {
                        // If no geometry, show error
                            errorMessage.textContent = "Sorry, this place cannot be found.";
                            document.getElementById("map").style.display = "none";
                            marker.setVisible(false);
                            return;
                        }

                        // Clear any previous error messages
                        errorMessage.textContent = "";

                        // Show the map and update location
                        document.getElementById("map").style.display = "block";
                        map.setCenter(place.geometry.location);
                        map.setZoom(14);
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                    });
                }
                </script>

                    <!-- Load the Google Maps API -->
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCelw4cTPbbBcxST_7k53wvy5U9G1JkLTE&libraries=places&callback=initAutocomplete"async defer></script>
            </form>
        </div>
    </div>
</div>

    <!-- Car Image Slideshow -->
    <div class="car-image-slider">
        <img src="./PHP/car1.jpg" alt="Car 1" class="car-image">
        <img src="./PHP/car2.jpg" alt="Car 2" class="car-image">
        <img src="./PHP/car3.jpg" alt="Car 3" class="car-image">
    </div>
    
    <div id="three-column-section">
    <div class="three-column-section">
    <div class="column">
        <h3>About Us</h3>
        <p>At RAR, we take pride in making car rentals simple, convenient, and dependable for everyone. Whether you’re planning a quick day trip, a family vacation, or need a reliable vehicle for extended use, we offer a wide range of well-maintained cars to suit every journey.</p>
    </div>
  
    <div class="column">
        <h3>Rental Options</h3>
        <p>Choose to rent a car for a day, a week, or longer — whatever fits your plans best. We also offer a convenient three-month payment plan to make your experience more affordable and flexible.</p>
    </div>
  
    <div class="column">
        <h3>Why Choose RAR</h3>
        <p>Enjoy a modern fleet, reliable support, and flexible terms for every journey. We’re here to help you hit the road with confidence.</p>
    </div>
    </div>
    </div>


    <!-- Browse Cars Section 
    <div id="browse-cars" class="browse-cars  ">
        <h1>Browse Cars for Rent</h1>
        <img src="carcollage.png" alt="Car collage" class="car-image">
        <button onclick="window.location.href='browse-cars.php'">Browse Cars</button>
    </div> -->
    <br><br>
    <div id="browse-cars" class="browse-cars-container">
    <div class="car-image-container">
        <img src="./PHP/carscollage.png" alt="Car collage" class="car-image">
    </div>
    <div class="browse-text">
        <h1>Browse Cars for Rent</h1>
        <button onclick="window.location.href='./PHP/browse-cars.php'" class="browse-btnn">Browse Cars</button>
    </div>
    </div>


     <!-- My Payment Status (Dashboard Widget) -->
     <div id="my-payment-section">
     <div class="my-payment-section">
        <h2>Have You Rented a Car? Check Your Payment Status!</h2>
        <p class="payment-explanation">
            If you have an active rental, you can view your payment plan details below and keep track of your installments or full payment.
         </p>
         <?php include './PHP/my_payment_status.php'; ?>
    </div>
    </div>


    <!-- Most Rented Cars Section 
    <div id="help" class="help">
        <h2>Need help?</h2>
        <div class="cars">
            <div class="car-item">Car 1</div>
            <div class="car-item">Car 2</div>
            <div class="car-item">Car 3</div>
        </div>
    </div>-->

    <!-- Meet the Hosts Section -->
    <section id="meet-the-hosts">
    <h2>Meet the Hosts</h2>
    <br>
    <div class="hosts-container">
        <div class="host">
            <img src="./logoimages/m.png" alt="Michelle Williams">
            <h3>Michelle Williams</h3>
            <p>Email: <a href="mailto:hh0111@wayne.edu">hh0111@wayne.edu</a></p>
        </div>
        <div class="host">
            <img src="./logoimages/t.png" alt="Tim Bui">
            <h3>Tim Bui</h3>
            <p>Email: <a href="mailto:buitimanh@wayne.edu">buitimanh@wayne.edu</a></p>
        </div>
        <div class="host">
            <img src="./logoimages/d.png" alt="Dheye Algalhan">
            <h3>Dheye Algalhan</h3>
            <p>Email: <a href="mailto:hz8323@wayne.edu">hz8323@wayne.edu</a></p>
        </div>
        <div class="host">
            <img src="./logoimages/f.png" alt="Faiza Laskar">
            <h3>Faiza Laskar</h3>
            <p>Email: <a href="mailto:faizaklaskar@gmail.com">faizaklaskar@gmail.com</a></p>
        </div>
    </div>
</section>

<div class="how-it-works-container">
  <div class="how-it-works-column">
    <h3>A Note from the Team Lead</h3>
    <p>Hi, I’m Faiza Laskar — welcome to RAR! I created this platform to make car rentals safer and more convenient, inspired by my own experiences and the challenges many people face finding reliable rides. With RAR, you have the freedom to choose a car when you need it, without the hassle or risks of traditional ride-sharing.</p>
    <img src=".\logoimages\redcar2.png" alt="Red Car" class="redcar-image">
</div>
<div class="question-mark">
    <img src=".\logoimages\questionmarkimg.png" alt="Question Mark">
</div>

  <div class="how-it-works-column">
    <h3>How It Works</h3>
    <ol>
      <li><strong>Sign Up & Log In:</strong> Create an account and log in to start your rental session.</li>
      <li><strong>Choose Your Location & Rental Type:</strong> Enter your location, then select whether to rent for a day or a week.</li>
      <li><strong>Pick a Car:</strong> Browse the available cars and choose the one that suits your trip.</li>
      <li><strong>Payment:</strong> Enter your payment info and choose to pay in full or use the three-month plan.</li>
      <li><strong>One Car at a Time:</strong> You can rent one car at a time. For another rental, contact me at faizaklaskar@gmail.com.</li>
      <li><strong>Return & Next Rental:</strong> Return the car and clear payments before renting again.</li>
    </ol>
  </div>
</div>


<section id="contact">
    <h2>Contact Us</h2>
    <div class="contact-box">
        <p>For any inquiries, reach out to us:</p>
        <p>Email: <a href="mailto:Rar@wayne.edu.com">Rar@wayne.edu</a></p>
    </div>
</section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Rar</p>
        <p><a href="./PHP/termsandconditions.php">Terms and Conditions</a> | <a href="./PHP/privacy.php">Privacy</a></p>
    </footer>

</body>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
  }
</script>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');
  }

  document.querySelectorAll('.sidebar-menu a, .sidebar-btn').forEach(link => {
    link.addEventListener('click', () => {
      document.getElementById('sidebar').classList.remove('open');
    });
  });
</script>
</html>
