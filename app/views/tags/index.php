<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('tag_message'); ?>

<div class="flex justify-between items-center mb-8">
    <div class="text-3xl font-bold">
        <h1 class="text-green-600 mt-6">Manage Tags</h1>
    </div>
    <div>
        <a href="<?= URLROOT ?>/tags/add" class="btn bg-green-800 text-white mt-16">
        <i class="fa-solid fa-plus"></i> Add Tag
        </a>
    </div>
</div>


<div class="mb-8">
    <label for="categoryFilter" class="block text-sm font-medium text-gray-600 mb-2">Filter by Category:</label>
    <select id="categoryFilter" class="form-select">
        <option value="">All Categories</option>
        <?php foreach ($data['categories'] as $category): ?>
            <option value="<?= $category->category_id; ?>"><?= $category->category_name; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<!-- <div class="flex justify-between"> -->






  <!-- Sidebar Toggle Button -->
  <div class="fixed top-8 right-8 cursor-pointer block lg:hidden" onclick="toggleSidebar()">
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
  </div>

  <!-- Sidebar -->
  <aside class="hidden lg:block lg:w-full lg:w-1/4 lg:w-1/3 sm:w-full bg-gray-800 text-white p-4 lg:mr-4 mb-4">
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
    <?php if (isset($data['tags']) && is_array($data['tags'])): ?>
        <?php foreach ($data['tags'] as $tag): ?>
            <div class="bg-white rounded-lg shadow-md p-4 md:flex md:flex-col lg:flex lg:flex-col">
                <!-- Delete Form -->
                <div class="flex justify-between w-full mb-2">
                    <h4 class="text-3xl font-semibold"><?= $tag->tagName; ?></h4>
                    <form class="inline" action="<?= URLROOT ?>/tags/delete/<?= $tag->tagId; ?>" method="post">
                        <button type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
                <p class="text-gray-600">Category: <?= $tag->categoryName; ?></p>

                <div class="mt-3 space-x-3">
                    <!-- Edit Form -->
                    <form class="inline" action="<?= URLROOT ?>/tags/edit/<?= $tag->tagId; ?>" method="post">
                        <label for="tag_name" class="text-gray-600">Edit Tag:</label>
                        <div class="flex items-center">
                            <input type="text" name="tag_name" class="form-input border rounded-md px-2 py-1" value="<?= $tag->tagName; ?>">
                            <input type="submit" value="Save" class="btn btn-success ml-2 py-1 px-3">
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>




<script>
    document.getElementById('categoryFilter').addEventListener('change', function () {
        filterTagsByCategory(this.value);
    });

    function filterTagsByCategory(categoryId) {
        fetch('<?php echo URLROOT; ?>/tags/filterByCategory', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'category_id=' + categoryId
        })
            .then(response => response.json())
            .then(data => {
                // Mettez à jour la liste des tags
                const tagContainer = document.getElementById('tagContainer');
                tagContainer.innerHTML = ''; // Effacez le contenu existant

                if (data.tags.length > 0) {
                    data.tags.forEach(tag => {
                        const tagElement = document.createElement('div');
                        tagElement.className = 'card card-body mb-3';
                        tagElement.innerHTML = `
                            <h4 class="card-title">${tag.tagName}</h4>
                            <p>Category: ${tag.categoryName}</p>
                            <div class="mt-3">
                                <!-- Formulaires d'édition et de suppression -->
                                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/edit/${tag.tagId}" method="post">
                                    <div class="form-group">
                                        <label for="tag_name">Modifier Tag:</label>
                                        <input type="text" name="tag_name" class="form-control" value="${tag.tagName}">
                                    </div>
                                    <input type="submit" value="Enregistrer" class="btn btn-success">
                                </form>
                                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/delete/${tag.tagId}" method="post">
                                    <input type="submit" value="Supprimer" class="btn btn-danger">
                                </form>
                            </div>
                        `;
                        tagContainer.appendChild(tagElement);
                    });
                } else {
                    tagContainer.innerHTML = '<p>Aucun tag trouvé pour cette catégorie.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>