<?php require APPROOT . '/views/inc/header.php'; ?>
<body class="font-sans bg-gray-100">

  <!-- Admin Dashboard Section -->
  <section class="flex h-screen">

    <!-- Sidebar Section -->
    <aside class="w-1/4 bg-gray-800 text-white p-8">
      <div class="mb-8">
        <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
      </div>
      <nav>
        <ul class="space-y-4">
          <li>
            <a href="<?php echo URLROOT; ?>/categories/index2" class="flex items-center text-lg py-2 px-4 rounded hover:bg-gray-700">
              <span class="mr-2">📁</span>
              Manage Categories
            </a>
          </li>
          <li>
            <a href="<?php echo URLROOT; ?>/tags/index2" class="flex items-center text-lg py-2 px-4 rounded hover:bg-gray-700">
              <span class="mr-2">🏷️</span>
              Manage Tags
            </a>
          </li>
          <li>
            <a href="<?php echo URLROOT; ?>/Wikis/index" class="flex items-center text-lg py-2 px-4 rounded hover:bg-gray-700">
              <span class="mr-2">📚</span>
              Manage Wikis
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center text-lg py-2 px-4 rounded hover:bg-gray-700">
              <span class="mr-2">📊</span>
              Dashboard Stats
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content Section -->
    <div class="w-3/4 p-8 bg-white rounded-md shadow-md">
      <!-- Main Content Section -->
    
      <!-- Dashboard Section -->
      <section class="container mx-auto my-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-4xl font-extrabold text-gray-800">Welcome to Your Dashboard</h2>
          <div class="flex items-center space-x-4">
            <span class="text-gray-600">Total Entities: <span class="text-black font-bold">500</span></span>
            <span class="text-gray-600">Active Entities: <span class="text-green-500 font-bold">350</span></span>
          </div>
        </div>

        <!-- Overview Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Total Entities Card -->
          <!-- ... (rest of your content) ... -->
        </div>

      
        <!-- Overview Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-blue-500 p-6 rounded-md shadow-md text-white">
                    <h3 class="text-lg font-semibold mb-4">Total Wikis</h3>
                    <p class="text-3xl font-bold">500</p>
                </div>
                
                <?php if (isset($data['totalTags'])) : ?>
                <div class="bg-green-500 p-6 rounded-md shadow-md text-white">
                    <h3 class="text-lg font-semibold mb-4">Total Tags</h3>
                    <p class="text-3xl font-bold"><?php echo $data['totalTags'];?></p>
                </div>
                <?php endif; ?>

                <?php if (isset($data['totalCategories'])): ?>
                <div class="bg-yellow-500 p-6 rounded-md shadow-md text-white">
                    <h3 class="text-lg font-semibold mb-4">Total Categories</h3>
                    <p class="text-3xl font-bold"><?php echo $data['totalCategories']; ?></p>
                </div>
                <?php endif; ?>


            </div>

            <!-- Charts and Graphs Section -->
            <div class="mt-8">
                <!-- Entity Distribution Chart -->
                <div class="bg-white p-8 rounded-md shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Entity Distribution</h3>
                    <!-- Include your chart or graph library here -->
                    <div class="w-full h-48 bg-gray-200"></div>
                </div>
            </div>

            <!-- Recent Activities Section -->
            <div class="mt-8">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Recent Activities</h3>
                <!-- Include a more interactive list or timeline of recent activities here -->
                <div class="bg-white p-6 rounded-md shadow-md">
                    <ul class="space-y-4">
                        <li>
                            <p class="text-gray-600">User John Doe created a new wiki.</p>
                            <span class="text-xs text-gray-400">2 hours ago</span>
                        </li>
                        <li>
                            <p class="text-gray-600">Category 'Technology' reached 100 articles.</p>
                            <span class="text-xs text-gray-400">1 day ago</span>
                        </li>
                        <!-- Add more list items as needed -->
                    </ul>
                </div>
            </div>
    

  </section>

</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>
