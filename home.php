<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="logo.png">
  <title>Home | Rent a Ride</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      font-family: Arial, sans-serif;
      color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

   .logo {
      display: flex;
      align-items: center;
    }

.logo img {
  height: 60px;
  width: 60px;
  margin-right: 10px;
}

.logo span {
  font-size: 18px;
  font-weight: bold;
}

  .image-wrapper {
    margin-top: 0px;
    text-align: center;
  }

  .image-wrapper img {
    max-width: 100%;
    height: auto;
  }

    nav ul {
      list-style: none;
      display: flex;
    }

    nav ul li {
      margin-left: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    .logout ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    .logout ul li {
      display: inline-block;
      margin-right: 10px;
    }

    .logout ul li a {
      color: #fff;
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #fff;
      border-radius: 5px;
    }

    nav ul li a:hover {
      background-color: #fff;
      color: #333;
    }

    .cta-button {
      display: inline-block;
      background-color: #ff6b6b;
      color: #fff;
      padding: 15px 30px;
      font-size: 18px;
      text-decoration: none;
      border-radius: 5px;
    }


    .customer-support {
      background-color: #f9f9f9;
      padding: 50px 0;
      text-align: center;
    }

    .customer-support h2 {
      font-size: 36px;
      margin-bottom: 30px;
    }

    .customer-support p {
      font-size: 18px;
      color: #666;
      margin-bottom: 30px;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    footer p {
      margin: 0;
    }

  </style>
</head>
<body>
  <header>
    <div class="logo">
    <img src="logo.png" alt="Logo" height="60px" width="60px" >
    <h1>Rent a Ride</h1 >
	<h2 style="color: #ff6600;">Welcome <span id="username"><?php echo $username; ?></span>!</h1>

    </div>
    <nav>
      <ul>
        <li><h3><a href="cars.php">Cars</a></h3></li>
        <li><h3><a href="bikes.php">Bikes</a></h3></li>
        <li><h3><a href="contact.php">Contact Us</a></h3></li>
        <li><h3><a href="customer.php">Customer Support</a></h3></li>
      </ul>
    </nav>
    <div class="logout">
      <ul>
        <li><a href="register.php">Logout</a></li>
      </ul>
    
  </header>

  <section class="hero">
    <div class="image-wrapper">
      <img src="poster.png" alt="Your Image">
    </div>
  </div>
</section>

  <section class="customer-support">
    <h2>Customer Support</h2>
    <p><a href="customer.php">We're here to assist you. Contact our support team:</p>
  </section>

  <div>
<section>
  <footer>
    <p>&copy; 2023 Travel Booking. All rights reserved.</p>
  </footer>
  </section>
  </div>
</body>
</html>