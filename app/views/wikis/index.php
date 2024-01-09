<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-3">
    <a href="<?php echo URLROOT; ?>/wikis/add" class="btn btn-success"><i class="bi bi-plus"></i> Add Wiki</a>
</div>

<div class="container mx-auto flex flex-col w-full items-center mt-8">
    <?php foreach ($data['wikis'] as $wiki): ?>
        <!-- Wiki Card -->
        <div class="max-w-xs bg-white  rounded-md overflow-hidden shadow-md transition-transform transform hover:scale-105 mb-4">
            <div class="flex justify-between   w-full">

            <h2 class="text-2xl font-bold mb-2 text-gray-800 mt-0 p-6"><?php echo $wiki->title; ?></h2>
            <div class="flex  justify-end p-2">
                <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->wiki_id; ?>" class="m-2 inline-block"><i class="fa-regular fa-pen-to-square"></i></a>
                <form class="d-inline" action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->wiki_id; ?>" method="post">
                    <button type="submit" class="mt-2 "><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>

            
           
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4 overflow-hidden" style="text-overflow: ellipsis; white-space: nowrap;"><?php echo $wiki->content; ?>.</p>
                <div class="flex items-center">
                    <?php if (property_exists($wiki, 'category_name')): ?>
                        <span class="text-sm text-gray-500 mr-2">Category:</span>
                        <p class="text-blue-500"><?php echo $wiki->category_name; ?></p>
                    <?php endif; ?>
                </div>

                <!-- Display Tags -->
                <div class="mt-2 flex items-center">
                    <span class="text-sm text-gray-500 mr-2">Tags:</span>
                    <?php if (property_exists($wiki, 'tags') && is_array($wiki->tags)): ?>
                        <p class="text-blue-500 mr-2"><?php echo implode(', ', $wiki->tags); ?></p>
                    <?php endif; ?>
                    <p class="text-blue-500">Tag2</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
