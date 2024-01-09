<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('category_message'); ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Categories</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?php echo URLROOT; ?>/Categories/add" class="btn btn-primary">
            <i class="fa fa-pencil"></i> Add Category
        </a>
    </div>
</div>

<?php if (isset($data['categories']) && is_array($data['categories'])): ?>
    <?php foreach ($data['categories'] as $category): ?>
        <div class="card card-body mb-3">
            <h4 class="card-title">
                <?php echo $category->category_name; ?>
            </h4>


            <div class="mt-3">
            <form class="d-inline" action="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->category_id; ?>" method="post">
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $category->category_id; ?>">
        <label for="category_name">Edit Category:</label>
        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $category->category_name; ?>">
    </div>
    <input type="submit" value="Enregistrer" class="btn btn-success">
</form>

                <form class="d-inline" action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->category_id; ?>"
                    method="post">
                    <input type="submit" value="Delete" class="btn btn-danger"  style="background-color:gray">
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>



<?php require APPROOT . '/views/inc/footer.php'; ?>