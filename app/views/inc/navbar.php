<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>

  <!-- Tailwind CSS link (add this if you haven't included it yet) -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Custom CSS for Navbar -->
  <style>
    .custom-navbar {
      background-color: #ff0000; /* Red color code */
    }

    /* Adjusted styles for smaller navbar width and inline links */
    .custom-navbar .container {
      max-width: 80%; /* Adjust the width as needed */
    }

    .custom-navbar a {
      display: inline-block;
      margin-right: 20px; /* Adjust the spacing between links */
    }

    .navbar-toggler {
      display: none; /* Hide the toggle button on larger screens */
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
<body class="bg-gray-100">

  <nav class="bg-red-500 p-4 custom-navbar">
    <div class="container mx-auto flex justify-between items-center">
      <a class="text-white text-2xl font-bold" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="hidden-md flex items-center" id="navbarsExampleDefault">
        <a class="text-white" href="<?php echo URLROOT; ?>/projets/index">Home</a>
        <a class="text-white" href="<?php echo URLROOT; ?>/pages/about">About</a>
        <div class="ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <a class="text-white" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
          <?php else : ?>
            <a class="text-white" href="<?php echo URLROOT; ?>/users/register">Register</a>
            <a class="text-white" href="<?php echo URLROOT; ?>/users/login">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Your page content goes here -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

</body>
</html>
