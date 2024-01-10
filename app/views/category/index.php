<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('category_message'); ?>

<div class="flex justify-between items-center mb-8">
    <div class="text-3xl font-bold">
        <h1 class="text-black mt-6">Categories</h1>
    </div>
    <div>
        <a href="<?= URLROOT ?>/categories/add" class="btn bg-green-800 text-white">
            <i class="fa fa-pencil"></i> Add Category
        </a>
    </div>
</div>

<!-- Sidebar Section -->
<div class="fixed top-8 right-8 cursor-pointer block lg:hidden" onclick="toggleSidebar()">
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
  </div>

  <!-- Sidebar -->
  <aside class="hidden lg:block lg:w-1/4 lg:w-1/3 sm:w-full bg-gray-800 text-white p-4 lg:mr-4 mb-4">
    <div class="mb-4">
      <h2 class="text-2xl lg:text-3xl font-semibold">Admin Dashboard</h2>
    </div>
    <nav>
      <ul class="space-y-2">
        <li>
          <a href="<?php echo URLROOT; ?>/categories/index2"
            class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">
            <span class="mr-2">📁</span>
            Manage Categories
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/tags/index2"
            class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">
            <span class="mr-2">🏷️</span>
            Manage Tags
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/Wikis/index2"
            class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">
            <span class="mr-2">📚</span>
            Manage Wikis
          </a>
        </li>
        <li>
          <a href="dashboard.php"
            class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">
            <span class="mr-2">📊</span>
            Dashboard Stats
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Your main content goes here -->
<!-- Your main content goes here -->

<script>
  function toggleSidebar() {
    const sidebar = document.querySelector('.lg\\:block'); // Use double backslash to escape the colon
    const displayValue = window.getComputedStyle(sidebar).getPropertyValue('display');
    sidebar.style.display = displayValue === 'none' || displayValue === '' ? 'block' : 'none';
  }
</script>


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (isset($data['categories']) && is_array($data['categories'])): ?>
        <?php foreach ($data['categories'] as $category): ?>
            <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between   w-full">
                <h4 class="text-lg font-semibold mb-2"><?= $category->category_name; ?></h4>
                <form class="inline" action="<?= URLROOT ?>/categories/delete/<?= $category->category_id; ?>" method="post">
                <button type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
                
                </div>
                <div class="mt-3 space-x-3">
                    <!-- Edit Form -->
                    <form class="inline" action="<?= URLROOT ?>/categories/edit/<?= $category->category_id; ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $category->category_id; ?>">
                            <label for="category_name" class="text-gray-600">Edit Category:</label>
                            <div class="flex items-center">
                                <input type="text" id="category_name" name="category_name" class="form-input border rounded-md px-2 py-1" value="<?= $category->category_name; ?>">
                                <input type="submit" value="Save" class="btn btn-success ml-2 py-1 px-3">
                            </div>
                        </div>
                    </form>

                    <!-- Delete Form -->
                   
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>





<?php require APPROOT . '/views/inc/footer.php'; ?>