<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Perfume Shopping Online</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: rgba(33, 33, 33, 0.95);
      padding-top: 18px;
      padding-bottom: 18px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      font-weight: 600;
      color: #f9c74f !important;
      letter-spacing: 1px;
    }

    .navbar-nav .nav-link {
      font-size: 18px;
      color: #ffffff !important;
      margin-right: 15px;
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #f9c74f !important;
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding-left: 12px;
      padding-right: 12px;
    }

    .dropdown-menu {
      background-color: #333;
      border: none;
      border-radius: 8px;
    }

    .dropdown-menu a {
      color: #fff;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .dropdown-menu a:hover {
      background-color: #555;
      color: #f9c74f;
    }

    .navbar-toggler {
      border-color: #f9c74f;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23f9c74f' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(249,199,79, 1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    @media (max-width: 991px) {
      .navbar-nav .nav-link {
        margin-right: 0;
        padding: 10px 15px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Perfume Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="admin_manage_category.php">Manage Category</a>
        </li>
      
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
            Reports
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="all_order_report.php">All Orders Reports</a>
            <a class="dropdown-item" href="#">Bill Reports</a>
            <a class="dropdown-item" href="customer_report.php">Customer Reports</a>
            <a class="dropdown-item" href="supplier_report.php">Supplier Reports</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div style="margin-top: 90px;"></div>
