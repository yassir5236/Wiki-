<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/tags" class="bg-black hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-backward mt-10 "></i> Back</a>
<div class="card bg-gray-100 mt-5 p-5">

    <h2 class="text-3xl font-bold mb-4">Edit Tags</h2>

    <form action="<?php echo URLROOT; ?>/Tags/edit" method="post">
        <div class="mb-4">
            <label for="tag_name" class="block text-gray-700 text-sm font-bold mb-2">Tag Name: <sup>*</sup></label>
            <input type="text" name="tag_name" class="w-full p-2 border rounded <?php echo (!empty($data['tag_name_err'])) ? 'border-red-500' : 'border-gray-300'; ?>" value="<?php echo $data['tag_name']; ?>">
            <?php if (!empty($data['tag_name_err'])) : ?>
                <p class="text-red-500 text-xs italic"><?php echo $data['tag_name_err']; ?></p>
            <?php endif; ?>
        </div>

        <input type="submit" value="Update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
