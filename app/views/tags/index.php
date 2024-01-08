<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('tag_message'); ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Tags</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?php echo URLROOT; ?>/tags/add" class="btn btn-primary">
            <i class="fa fa-pencil"></i> Ajouter Tag
        </a>
    </div>
</div>

<?php if (isset($data['tags']) && is_array($data['tags'])): ?>
    <?php foreach ($data['tags'] as $tag): ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $tag->tagName; ?></h4>
            <p>Category: <?php echo $tag->categoryName; ?></p>

            <div class="mt-3">
                <!-- Edit Form -->
                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tagId; ?>" method="post">
                    <div class="form-group">
                        <label for="tag_name">Edit Tag:</label>
                        <input type="text" name="tag_name" class="form-control" value="<?php echo $tag->tagName; ?>">
                    </div>
                    <input type="submit" value="Enregistrer" class="btn btn-success">
                </form>

                <!-- Delete Form -->
                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tagId; ?>" method="post">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>