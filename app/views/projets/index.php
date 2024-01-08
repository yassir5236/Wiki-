<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('Admin_message'); ?>



<div class=" mb-3">
<div class="text-4xl mb-10 mt-10 text-center  font-bold">Welcome to your To do list</div>
    <a href="<?php echo URLROOT; ?>/Admin/index" class="bg-red-500 hover:bg-blue-700 text-white mt-10 font-bold py-2 px-4 rounded">
        <i class="fas fa-pencil-alt"></i> Ajouter Tag
    </a>
</div>



<?php
$user_id = $_SESSION['user_id'];

foreach ($data['Tags'] as $tag):
    if ($tag->userId != $user_id) {
        continue;
    }
    ?>

    <div class="bg-white shadow-md rounded-md p-4 mb-3">
        <h4 class="text-xl font-semibold mb-2"><?php echo $tag->tag_name; ?></h4>

        

       

        <?php if ($tag->userId == $_SESSION['user_id']): ?>
            <div class="mt-3">
                <a href="<?php echo URLROOT; ?>/Admin/edit_tag/<?php echo $tag->tagId; ?>" class="bg-gray-400 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Modifier</a>

                <form class="inline-block" action="<?php echo URLROOT; ?>/Admin/delete_tag/<?php echo $tag->tagId; ?>" method="post">
                    <input type="submit" value="Supprimer" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                </form>
            </div>
        <?php endif; ?>
    </div>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
