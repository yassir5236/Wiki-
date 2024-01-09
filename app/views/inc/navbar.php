<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Tailwind CSS link (add this if you haven't included it yet) -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Custom CSS for Navbar -->
  <style>
    .custom-login-button {
      background-color: black;
      color: white;
      padding: 8px 16px;
      border-radius: 4px;
      text-decoration: none;
    }

    .custom-search-bar {
      width: 200px; /* Adjust the width as needed */
    }

    /* Adjusted styles for smaller navbar width and inline links */
    .custom-navbar .container {
      max-width: 80%; /* Adjust the width as needed */
    }

    .custom-navbar a {
      display: inline-block;
      margin-right: 4; /* Adjust the spacing between links */
    }

    /* Style the burger menu (navbar-toggler) */
    .navbar-toggler {
      color: black; /* Set the color of the burger menu icon to black */
      border: 1px solid black; /* Set the border color to black */
    }

    @media (max-width: 768px) {
      .navbar-toggler {
        display: block; /* Show the toggle button on smaller screens */
      }

      .custom-navbar a {
        display: block;
        margin: 10px 0; /* Adjust the spacing for mobile view */
      }

      .hidden-md {
        display: none; /* Hide the navbar links on smaller screens */
      }
    }
  </style>
</head>
<body class="bg-gray-300">
  <!-- Navbar code -->
  <nav class="bg-gray-300 p-4 custom-navbar">
    <div class="container mx-auto flex justify-between items-center text-black">
      <a class="text-black text-4xl font-bold" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <div class="flex-grow ml-4 w-3/5 p-2 bg-gray-400 rounded mr-8">
      <i class='fa-solid fa-magnifying-glass'></i>
        <input type="text" placeholder="Search... " class = "bg-gray-400 text-black w-3/5 focus:border-none focus:outline-none placeholder-black">
      </div>
      <button class="navbar-toggler hidden" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="hidden-md flex items-center" id="navbarsExampleDefault">
        <a class="text-black p-2" href="<?php echo URLROOT; ?>/categories/index">Home</a>
        <?php if(isset($_SESSION['user_id']) && isAdmin()): ?>
          <a class="text-black p-2" href="<?php echo URLROOT; ?>/Pages/dashboard">Dashboard</a>
        <?php endif; ?>
        <div class="ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <a class="text-black p-2" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          <?php else : ?>
            <a class="text-black custom-login-button font-bold p-2 " href="<?php echo URLROOT; ?>/users/login">Login</a>
            <a class="text-black border-2 rounded-lg border-slate-400 p-4" href="<?php echo URLROOT; ?>/users/register">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Your page content goes here -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
