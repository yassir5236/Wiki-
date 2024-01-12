<?php require APPROOT . '/views/inc/header.php'; ?>



<div id="searchResultsContainer">
    <!-- Display search results here -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchResultsContainer = document.getElementById('searchResultsContainer');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();

        // Check if the search term is empty
        if (searchTerm === '') {
            // Clear the search results container
            searchResultsContainer.innerHTML = '';
            return;
        }

        // Perform AJAX request
        const xhr = new XMLHttpRequest();

        xhr.open('GET', `<?php echo URLROOT; ?>/Wikis/search?search=${searchTerm}`, true);

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success! Handle the response and update the content
                const response = JSON.parse(xhr.responseText);
                // Update the content based on the response
                updateSearchResults(response);
            } else {
                // Error handling
                console.error('Request failed');
            }
        };

        xhr.onerror = function () {
            // Network error
            console.error('Network error');
        };

        xhr.send();
    });

    function updateSearchResults(results) {
        // Clear previous results
        searchResultsContainer.innerHTML = '';

        if (results.length > 0) {
            // Display the search results
            results.forEach(result => {
                const resultElement = document.createElement('div');
                resultElement.classList.add('search-result');

                // Display result data (customize based on your data structure)
                resultElement.innerHTML = `
                    <h2>${result.title}</h2>
                    <p>${result.content}</p>
                    <p>Category: ${result.category_name}</p>
                    <p>Tags: ${result.tags || 'None'}</p>
                    <!-- Add more data as needed -->

                    <hr>
                `;

                searchResultsContainer.appendChild(resultElement);
            });
        } else {
            // Display a message when no results are found
            const noResultsMessage = document.createElement('p');
            noResultsMessage.textContent = 'No results found.';
            searchResultsContainer.appendChild(noResultsMessage);
        }
    }
});
</script>



<?php require APPROOT . '/views/inc/footer.php'; ?>
