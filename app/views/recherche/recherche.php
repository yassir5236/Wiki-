


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