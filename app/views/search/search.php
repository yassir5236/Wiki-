<?php require APPROOT . '/views/inc/header.php'; ?>


<a href="<?php echo URLROOT; ?>/Wikis/search">search</a>


// search.js

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();

        // Perform AJAX request
        const xhr = new XMLHttpRequest();

        xhr.open('GET', `your_search_endpoint.php?search=${searchTerm}`, true);

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success! Handle the response and update the content
                const response = JSON.parse(xhr.responseText);
                // Update the content based on the response
                console.log(response);
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
});
</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>
