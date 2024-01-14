 <?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex items-center justify-center my-8">
    <h1 class="text-4xl font-extrabold text-green-600">Create a New Wiki</h1>
</div>

<form action="<?php echo URLROOT; ?>/wikis/add" method="post" class="max-w-md mx-auto mb-10 bg-gray-100 p-8 rounded-lg shadow-md">
    <div class="mb-6">
        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
        <input type="text" name="title" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500" required>
    </div>
    <div class="mb-6">
        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
        <textarea name="content" class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500" required></textarea>
    </div>
  
  
    <div class="mb-6">
        <label for="category" class=" block text-sm font-semibold text-gray-700 mb-2 form-label">Category</label>
        <select name="category_id" id="categoryId" class=" form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 form-select">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="selectedTagsInput" class="form-label">Tags</label>
        <input type="hidden" id="selectedTagsInput" name="selectedTagsInput" class=" form-control">

        <div id="tagsContainer" class=" "></div>
    </div>
    <div class="pt-1 mb-3 d-flex mt-2 justify-content-end">
        <button class="btn  btn-md btn-block bg-green-500  text-white " type="submit" name="submit">Valider</button>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectedTags = [];
        var tagsContainer = document.getElementById("tagsContainer");
        var categorySelect = document.getElementById("categoryId");

        function updateTags() {
            tagsContainer.innerHTML = "";

            var categoryId = categorySelect.value;
            var tags = <?php echo json_encode($data['categoryTags']); ?>[categoryId];

            if (tags) {
                tags.forEach(function (tag) {
                    var tagButton = document.createElement("button");
                    tagButton.textContent = tag.tag_name;
                    tagButton.type = "button";
                    tagButton.classList.add("bg-green-400", "m-2", "text-white", "text-sm", "font-medium", "me-2", "cursor-pointer", "px-3", "py-1", "rounded");
                    tagButton.dataset.tagId = tag.tag_id;

                    tagButton.addEventListener("click", function () {

                        this.classList.toggle("bg-blue-500");
                        var index = selectedTags.indexOf(tag.tag_id);
                        if (index === -1) {
                            selectedTags.push(tag.tag_id);
                        } else {
                            selectedTags.splice(index, 1);
                        }
                        selectedTagsInput.value = JSON.stringify(selectedTags);
                        console.log(selectedTags);
                    });

                    tagsContainer.appendChild(tagButton);
                });
            }
        }

        updateTags();

        categorySelect.addEventListener("change", function () {
            selectedTags = [];
            updateTags();
        });
    });

    function ToDetailWiki(element) {
        var wikiId = element.getAttribute('data-wiki-id');
        var wikiUrl = "<?php echo URLROOT . '/WikiController/singleWiki/'; ?>" + wikiId;
        window.location.href = wikiUrl;
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
