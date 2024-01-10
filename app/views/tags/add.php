<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/tags/index" class="btn bg-black text-white mt-10"><i class="fa fa-backward"></i> Back</a>

<div class="card bg-light mt-5 p-5">
    <h2 class="text-3xl font-bold text-green-600 mb-4">ADD Tags</h2>

    <form action="<?php echo URLROOT; ?>/Tags/add" method="post">
        <div class="mb-4">
            <label for="tag_name" class="form-label">Tag Name: <sup></sup></label>
            <input type="text" name="tag_name" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['tag_name']; ?>">

            <?php  if (isset($data['title_err']) && !empty($data['title_err'])) : ?>
                <?php echo '<script>
            alert("' . $data['title_err'] . '");
            </script>';
            ?>
             <?php endif; ?>

            <?php if (!empty($data['tag_name_err'])) : ?>
                <div class="invalid-feedback"><?php echo $data['title_err']; ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="category_id" class="form-label">Select Category: <sup></sup></label>
            <select name="category_id" class="form-control <?php echo (!empty($data['category_id_err'])) ? 'is-invalid' : ''; ?>">
                <?php foreach ($data['categories'] as $category) : ?>
                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                <?php endforeach; ?>
            </select>

            <?php if (!empty($data['category_id_err'])) : ?>
                <div class="invalid-feedback"><?php echo $data['category_id_err']; ?></div>
            <?php endif; ?>
        </div>

        <input type="submit" value="Create " class=" btn bg-green-500 text-white">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>