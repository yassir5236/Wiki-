<?php require APPROOT . '/views/inc/header.php'; ?>
    <a href="<?php echo isset($_SESSION['user_id']) ? URLROOT . '/Wikis/userWikis' : URLROOT . '/Pages/index'; ?>" class="flex items-center text-gray-500 hover:text-gray-700 transition duration-300">
    <i class="fas fa-arrow-left mr-2"></i> Back
</a>

<div class="container mx-auto mt-12 p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-6"><?= $data['wiki']->title ?></h1>

    <div class="flex items-center text-gray-600 mb-4">
        <p class="mr-4">Created by: <?= $data['wiki']->author_name ?></p>
        <p>Created on: <?= $data['wiki']->created_at ?></p>
    </div>

    <p class="text-gray-700 mb-8"><?= $data['wiki']->content ?></p>

    <div class="flex items-center text-gray-600 mb-4">
        <p class="mr-2">Category:</p>
        <p class="font-semibold"><?= $data['wiki']->category_name ?></p>
    </div>

    <div class="mb-6">
        Tags:
        <?php foreach ($data['wiki']->tags as $tag) : ?>
            <span class="inline-block bg-blue-500 text-white rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                <?= $tag ?>
            </span>
        <?php endforeach; ?>
    </div>
    <!-- Add other wiki details if necessary -->
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>