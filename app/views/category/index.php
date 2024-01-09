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