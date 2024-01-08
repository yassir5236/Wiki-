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
<body class="bg-gray-300">





  <!-- Navbar code -->
 <nav class="bg-gray-300 p-4 custom-navbar  ">
    <div class="container mx-auto flex justify-between items-center text-black">
      <a class="text-black text-4xl font-bold" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <div class="flex-grow ml-4">
            <input type="text" placeholder="&#128269; Search... " class="w-3/5 p-2 bg-gray-400 rounded mr-8 focus:outline-none focus:shadow-outline-gray">
        </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="hidden-md flex items-center" id="navbarsExampleDefault">
    <a class="text-black" href="<?php echo URLROOT; ?>/categories/index">Home</a>
    <?php if(isset($_SESSION['user_id']) && isAdmin()): ?>
      <a class="text-black" href="<?php echo URLROOT; ?>/Pages/dashboard">Dashboard</a>
    <?php endif; ?>
    <div class="ml-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <a class="text-black" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
      <?php else : ?>
        <a class="text-black custom-login-button font-bold" href="<?php echo URLROOT; ?>/users/login">Login</a>
        <a class="text-black text-black border-2 rounded-lg  border-slate-400 p-4" href="<?php echo URLROOT; ?>/users/register">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>


  

  <!-- Your page content goes here -->

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

</body>
</html>
