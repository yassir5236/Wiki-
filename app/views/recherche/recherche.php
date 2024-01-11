
<div class="max-w-sm rounded overflow-hidden shadow-lg ">
  <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
  <div class="px-6 py-4">
    <div class="flex justify-between items-center mb-2">
      <div class="font-bold text-xl"><?php echo $wiki->title; ?></div>
      <div class="flex">
        <a href="#" class="text-blue-500 hover:text-blue-700 mr-2">
          <i class="fas fa-edit"></i> Modifier
        </a>
        <a href="#" class="text-red-500 hover:text-red-700">
          <i class="fas fa-trash-alt"></i> Supprimer
        </a>
      </div>
    </div>
    <p class="text-gray-700 text-base break-words">
      <?php echo $wiki->content; ?>
    </p>
  </div>
  <div class="px-6 pt-4 pb-2">
    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#<?php echo implode(', ', (array) $wiki->tags); ?></span>
    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
  </div>
</div>
<?php endforeach; ?>































































<?php
public function search() {
        // Check if it's an AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchTerm'])) {
            $searchTerm = $_POST['searchTerm'];

            $searchResults = $this->searchWikiTagCategory($searchTerm);

            echo json_encode($searchResults);
            exit;
        }

    }

    public function searchWikiTagCategory($searchTerm) {
        $searchResults = [];

        // Search by Wiki
        $wikiResults = $this->wikiModel->searchWiki($searchTerm);
        $searchResults['wikis'] = $wikiResults;

        // Search by Tag
        $tagResults = $this->wikiModel->searchTag($searchTerm);
        $searchResults['tags'] = $tagResults;

        // Search by Category
        $categoryResults = $this->wikiModel->searchCategory($searchTerm);
        $searchResults['categories'] = $categoryResults;

        return $searchResults;
    }





    public function search() {
        // Check if it's an AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchTerm'])) {
            $searchTerm = $_POST['searchTerm'];

            $searchResults = $this->searchWikiTagCategory($searchTerm);

            echo json_encode($searchResults);
            exit;
        }

    }

    public function searchWikiTagCategory($searchTerm) {
        $searchResults = [];

        // Search by Wiki
        $wikiResults = $this->wikiModel->searchWiki($searchTerm);
        $searchResults['wikis'] = $wikiResults;

        // Search by Tag
        $tagResults = $this->wikiModel->searchTag($searchTerm);
        $searchResults['tags'] = $tagResults;

        // Search by Category
        $categoryResults = $this->wikiModel->searchCategory($searchTerm);
        $searchResults['categories'] = $categoryResults;

        return $searchResults;
    }
    ?>