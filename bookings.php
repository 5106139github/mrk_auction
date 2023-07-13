<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>

    <?php
	session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_SESSION['username'])) {
        // Retrieve form data
        $carIndex = $_POST['car_index'] ?? '';
        $startDate = $_POST['start_date'] ?? '';
        $endDate = $_POST['end_date'] ?? '';
        $startLocation = $_POST['start_location'] ?? '';
        $destination = $_POST['destination'] ?? '';

        if ($carIndex === '' || $startDate === '' || $endDate === '' || $startLocation === '' || $destination === '') {
            echo "<p>Please fill in all the required fields.</p>";
        } elseif ($endDate < $startDate) {
            echo "<p>End date cannot be before the start date.</p>";
        } else {
            // Create car booking system
            class Car {
                public $make;
                public $model;

                public function __construct($make, $model) {
                    $this->make = $make;
                    $this->model = $model;
                }

                public function __toString() {
                    return "{$this->make} {$this->model}";
                }
            }

            class CarBookingSystem {
                public $cars = [];

                public function addCar($car) {
                    $this->cars[] = $car;
                }

              public function isCarAvailable($carIndex, $startDate, $endDate) {
    // Check if the car is available for the selected date range
    $selectedCar = $this->cars[$carIndex] ?? null;
    if ($selectedCar === null) {
        return false;
    }

    // Retrieve existing bookings from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project3";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement to retrieve existing bookings for the selected car and date range
    $stmt = $conn->prepare("SELECT * FROM booking_car WHERE carname = ? AND ((startdate <= ? AND enddate >= ?) OR (startdate <= ? AND enddate >= ?) OR (startdate >= ? AND enddate <= ?) OR (startdate <= ? AND enddate >= ?))");
    $stmt->bind_param("sssssssss", $carName, $startDate, $startDate, $endDate, $endDate, $startDate, $endDate, $startDate, $endDate);

    // Set the values for the SQL statement
    $carName = $selectedCar->make . " " . $selectedCar->model;

    // Execute the SQL statement
    $stmt->execute();

    // Check if there are any conflicting bookings
    $result = $stmt->get_result();
    $bookingCount = $result->num_rows;

    // Close the database connection
    $stmt->close();
    $conn->close();

    return $bookingCount === 0;


                   
                }
            }

            // Retrieve car details from the booking system
            $bookingSystem = new CarBookingSystem();

            // Creating car objects
            $car1 = new Car("Toyota", "Camry");
            $car2 = new Car("Honda", "Accord");
            $car3 = new Car("Ford", "Mustang");
            $car4 = new Car("Tesla", "Model 3");

            // Adding cars to the booking system
            $bookingSystem->addCar($car1);
            $bookingSystem->addCar($car2);
            $bookingSystem->addCar($car3);
            $bookingSystem->addCar($car4);

            // Retrieve the selected car
            $selectedCar = $bookingSystem->cars[$carIndex] ?? null;

            if ($selectedCar === null) {
                echo "<p>Invalid car selection.</p>";
            } elseif (!$bookingSystem->isCarAvailable($carIndex, $startDate, $endDate)) {
                echo "<p>The selected car is not available for the selected date range.</p>";
            } else {
                // Display the booking details
                echo "<h2>Booking Successful</h2>";
                echo "<p>You have successfully booked the car.</p>";
                echo "<p>Car: " . $selectedCar->make . " " . $selectedCar->model . "</p>";
                echo "<p>Start Date: " . $startDate . "</p>";
                echo "<p>End Date: " . $endDate . "</p>";
                echo "<p>Start Location: " . $startLocation . "</p>";
                echo "<p>Destination: " . $destination . "</p>";

                // Insert booking details into the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "project3";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and bind the SQL statement
                $stmt = $conn->prepare("INSERT INTO booking_car (username, carname, startdate, enddate, startlocation, endlocation) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $username, $carName, $startDate, $endDate, $startLocation, $destination);

                // Set the values for the SQL statement
                $username = $_SESSION['username']; // Replace with the actual username
                $carName = $selectedCar->make . " " . $selectedCar->model;

                // Execute the SQL statement
                if ($stmt->execute()) {
                    echo "<p>Booking details inserted into the database successfully.</p>";
                } else {
                    echo "<p>Error inserting booking details: " . $stmt->error . "</p>";
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
            }
        }
    } else {
        echo "<p>Invalid Request</p>";
    }
	}
    ?>
<div class="back-buttons">
        <a href="cars.php">Back to Cars</a>
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
