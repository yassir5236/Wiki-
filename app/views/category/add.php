<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/tags/index" class="p-2 rounded  bg-black text-white mt-10"><i class="fa fa-backward mt-10 "></i> Back</a>
<div class="card bg-gray-100 mt-5 p-5">

    <h2 class="text-3xl font-bold mb-4">ADD Category</h2>

    <form action="<?php echo URLROOT; ?>/Categories/add" method="post">
        <div class="mb-4">
            <label for="tag_name" class="block text-gray-700 text-sm font-bold mb-2">Category Name: <sup>*</sup></label>
            <input type="text" name="category_name" class="w-full p-2 border rounded <?php echo (!empty($data['title_err'])) ? 'border-red-500' : 'border-gray-300'; ?>" value="<?php echo $data['category_name']; ?>">
        
       
            <?php if (!empty($data['category_name_err'])) : ?>
                <p class="text-red-500 text-xs italic"><?php echo $data['category_name_err']; ?></p>
            <?php endif; ?>
        </div>

        <input type="submit" value="Create" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
