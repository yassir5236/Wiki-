<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/Wikis/index2" class="btn bg-black text-white mt-10 mb-4"><i class="fa fa-backward"></i> Back</a>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (isset($data['categories']) && is_array($data['categories'])): ?>
        <?php foreach ($data['categories'] as $category): ?>
            <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between   w-full">
                <h4 class="text-lg font-semibold mb-2"><?= $category->category_name; ?></h4>
               
                </div>
                <div class="mt-3 space-x-3">
                    <!-- Edit Form -->
                  

                    <!-- Delete Form -->
                   
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>