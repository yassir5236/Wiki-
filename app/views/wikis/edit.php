<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex items-center justify-center my-8">
    <h1 class="text-4xl font-extrabold text-green-600">Edit Wiki</h1>
</div>

<form action="<?php echo URLROOT; ?>/wikis/edit/<?php echo $data['wiki']->wiki_id; ?>" method="post" class="max-w-md mx-auto bg-gray-100  mb-10 p-8 rounded-lg shadow-md">
    <div class="mb-10 ">
        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
        <input type="text" name="title" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500" value="<?php echo $data['wiki']->title; ?>">
    </div>
    <div class="mb-6">
        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
        <textarea name="content" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500"><?php echo $data['wiki']->content; ?></textarea>
    </div>
    <div class="mb-6">
        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
        <select name="category_id" class="form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category->category_id; ?>" <?php echo ($category->category_id == $data['wiki']->category_id) ? 'selected' : ''; ?>><?php echo $category->category_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-6">
        <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">Tags</label>
        <select name="tags[]" class="form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500" multiple>
            <?php foreach ($data['tags'] as $tag): ?>
                <option value="<?php echo $tag->tag_id; ?>" <?php echo (property_exists($data['wiki'], 'tags') && is_array($data['wiki']->tags) && in_array($tag->tag_id, $data['wiki']->tags)) ? 'selected' : ''; ?>><?php echo $tag->tag_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn text-white bg-green-500 ">Update Wiki</button>

</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
