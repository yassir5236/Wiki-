
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mx-auto mt-8 break-words">
    <h1 class="text-3xl font-bold mb-4"><?php echo $data['wiki']->title; ?></h1>

    <p class="text-gray-700 mb-2">Created by: <?php echo $data['wiki']->author_name; ?></p>
    <p class="text-gray-500 mb-2">Created on: <?php echo $data['wiki']->created_at; ?></p>

    <p class="text-gray-700 mb-4"><?php echo $data['wiki']->content; ?></p>

    <p class="text-gray-500 mb-4">Category: <?php echo $data['wiki']->category_name; ?></p>

    <div class="mb-4">
        Tags:
        <?php foreach ($data['wiki']->tags as $tag): ?>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                <?php echo $tag; ?>
            </span>
        <?php endforeach; ?>
    </div>
    <!-- Ajoutez d'autres détails du wiki si nécessaire -->
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>