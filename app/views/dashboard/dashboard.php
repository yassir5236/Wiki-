
<?php require APPROOT . '/views/inc/header.php'; ?>
<body class="font-sans bg-gray-100">
<!-- Admin Dashboard Section -->
<section class="flex container mx-auto my-8 bg-white rounded-md shadow-md">

    <!-- Sidebar Section -->
    <aside class="w-1/4 bg-gray-800 text-white p-8">
        <h2 class="text-2xl font-semibold mb-8">Admin Dashboard</h2>
        <nav>
            <ul class="space-y-4">
                <li><a href="#manageCategories" class="block hover:text-blue-500">Manage Categories</a></li>
                <li><a href="#manageTags" class="block hover:text-blue-500">Manage Tags</a></li>
                <li><a href="#manageWikis" class="block hover:text-blue-500">Manage Wikis</a></li>
                <li><a href="#dashboardStats" class="block hover:text-blue-500">Dashboard Stats</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content Section -->
    <main class="w-3/4 p-8">
        <!-- Manage Categories Section -->
        <section id="manageCategories" class="mb-8">
            <h3 class="text-3xl font-semibold mb-4 text-gray-800">Manage Categories</h3>
            <!-- Add your category management content here -->
        </section>

        <!-- Manage Tags Section -->
        <section id="manageTags" class="mb-8">
            <h3 class="text-3xl font-semibold mb-4 text-gray-800">Manage Tags</h3>
            <!-- Add your tag management content here -->
        </section>

        <!-- Manage Wikis Section -->
        <section id="manageWikis" class="mb-8">
            <h3 class="text-3xl font-semibold mb-4 text-gray-800">Manage Wikis</h3>
            <!-- Add your wiki management content here -->
        </section>

        <!-- Dashboard Stats Section -->
        <section id="dashboardStats" class="mb-8">
            <h3 class="text-3xl font-semibold mb-4 text-gray-800">Dashboard Stats</h3>
            <!-- Add your dashboard statistics content here -->
        </section>
    </main>

</section>
</body>

<?php require APPROOT . '/views/inc/footer.php'; ?>





