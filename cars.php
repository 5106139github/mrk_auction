<!DOCTYPE html>
<html>
<head>
    <title>Car Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #333;
            margin-top: 30px;
        }

        .car-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fff;
        }

        .car-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        .car-details {
            margin-top: 10px;
        }

        .car-details p {
            margin: 5px 0;
        }

        form {
            margin-top: 10px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="date"],
        form input[type="text"],
        form input[type="submit"] {
            margin-bottom: 10px;
            padding: 5px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #555;
        }

        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-home a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Car Booking</h1>

    <?php
    class Car {
        public $make;
        public $model;
        public $year;
        public $available;
        public $pricePerKm;
        public $seatingCapacity;
        public $ac;
        public $image;

        public function __construct($make, $model, $year, $available = true, $pricePerKm, $seatingCapacity, $ac, $image) {
            $this->make = $make;
            $this->model = $model;
            $this->year = $year;
            $this->available = $available;
            $this->pricePerKm = $pricePerKm;
            $this->seatingCapacity = $seatingCapacity;
            $this->ac = $ac;
            $this->image = $image;
        }

        public function __toString() {
            return "{$this->year} {$this->make} {$this->model}";
        }
    }

    class CarBookingSystem {
        public $cars = [];

        public function addCar($car) {
            $this->cars[] = $car;
        }

        public function displayAvailableCars() {
            $availableCars = array_filter($this->cars, function($car) {
                return $car->available;
            });

            if (!empty($availableCars)) {
                echo "<h2>Available Cars</h2>";
                foreach ($availableCars as $index => $car) {
                    echo "<div class='car-container'>";
                    echo "<h3>{$car->make} {$car->model}</h3>";
                    echo "<div class='car-image'><img src='{$car->image}' alt='Car Image' class='car-image'></div>";
                    echo "<div class='car-details'>";
                    echo "<p>Year: {$car->year}</p>";
                    echo "<p>Price per KM: {$car->pricePerKm}</p>";
                    echo "<p>Seating Capacity: {$car->seatingCapacity}</p>";
                    echo "<p>AC: " . ($car->ac ? 'Yes' : 'No') . "</p>";
                    echo "</div>";
                    echo "<form action='bookings.php' method='post'>";
                    echo "<input type='hidden' name='car_index' value='{$index}'>";
                    echo "<label for='start_date'>Start Date:</label>";
                    echo "<input type='date' name='start_date' min='" . date('Y-m-d') . "' required><br>";
                    echo "<label for='end_date'>End Date:</label>";
                    echo "<input type='date' name='end_date' min='" . date('Y-m-d') . "' required><br>";
                    echo "<label for='start_location'>Start Location:</label>";
                    echo "<input type='text' name='start_location' required><br>";
                    echo "<label for='destination'>Destination:</label>";
                    echo "<input type='text' name='destination' required><br>";
                    echo "<input type='submit' name='book_now' value='Book Now'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No cars available.</p>";
            }
        }

        public function bookCar($carIndex) {
            if (isset($this->cars[$carIndex]) && $this->cars[$carIndex]->available) {
                $this->cars[$carIndex]->available = false;
            }
        }
    }

    // Creating car booking system
    $bookingSystem = new CarBookingSystem();

    // Creating car objects
    $car1 = new Car("Toyota", "Camry", 2022, true, 10.5, 5, true, "car1.jpg");
    $car2 = new Car("Honda", "Accord", 2021, true, 9.0, 4, false, "car2.jpg");
    $car3 = new Car("Ford", "Mustang", 2023, true, 15.0, 2, true, "car3.jpg");
    $car4 = new Car("Tesla", "Model 3", 2023, true, 12.0, 4, true, "car4.jpg");

    // Adding cars to the booking system
    $bookingSystem->addCar($car1);
    $bookingSystem->addCar($car2);
    $bookingSystem->addCar($car3);
    $bookingSystem->addCar($car4);

    // Displaying available cars
    $bookingSystem->displayAvailableCars();
    ?>

    <div class="back-to-home">
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
