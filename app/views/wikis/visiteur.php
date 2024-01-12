<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Sidebar Section -->
<!-- Sidebar Toggle Button -->
<div class="fixed top-8 right-8 cursor-pointer block lg:hidden" onclick="toggleSidebar()">
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
    <span class="block w-6 h-1 bg-black my-1"></span>
</div>

<!-- Sidebar -->
<aside class="  hidden  sticky mx-auto lg:block  lg:w-full xl:w-1/2 lg:w-1/4 lg:w-1/3 sm:w-full bg-gray-800 text-white p-4 lg:mr-4 mb-4">
    <div class="mb-4">
        <h2 class="text-2xl lg:text-3xl font-semibold">Welcome !!</h2>
    </div>
    <nav>
        <ul class="space-y-2">


            <li>
                <a href="<?php echo URLROOT; ?>/Wikis/index2" class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">
                    <span class="mr-2">📚</span>
                    Acceuil
                </a>
            </li>

            <li>
                <a href="<?php echo URLROOT; ?>/Categories/index3" class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700">

                    <span class="mr-2">🗂️</span>Categories
                </a>
            </li>
            <li>
                <a class="flex items-center text-base lg:text-lg py-2 px-2 lg:px-4 rounded transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-700" href="<?php echo URLROOT; ?>/users/register"> <span class="mr-2">🔒</span> register </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Your main content goes here -->
<!-- Your main content goes here -->

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.lg\\:block'); // Use double backslash to escape the colon
        const displayValue = window.getComputedStyle(sidebar).getPropertyValue('display');
        sidebar.style.display = displayValue === 'none' || displayValue === '' ? 'block' : 'none';
    }
</script>

<div id="searchResults"></div>


<div id="searchResultsContainer">

    <div class="container   mx-auto flex flex-col  items-center  mt-8">
        <?php foreach ($data['wikis'] as $wiki) : ?>
            <!-- Wiki Card -->
            <div class="w-1/2 w-full md:w-1/2 lg:w-1/3 xl:w-1/2 h-80 flex flex-col justify-between  bg-white rounded-md overflow-hidden shadow-md transition-transform transform hover:scale-105 mb-4 px-3 py-1">
                <div class="text-wrap flex flex-col w-full ">

                    <h2 class=" text-2xl font-bold   w-4/5 text-gray-800 mt-2 px-4 "><?= substr($wiki->title, 0, 20); ?>
                        <?= strlen($wiki->title) > 20 ? '...' : ''; ?></h2>

                </div>

                <div>
                    <p class="whitespace-normal w-full text-gray-600 mb-4  break-words overflow-hidden" style="text-overflow: ellipsis; white-space: nowrap;"><?= substr($wiki->content, 0, 70); ?>
                        <?= strlen($wiki->content) > 70 ? '...' : ''; ?>.</p>
                    <div class="flex items-center">
                        <?php if (property_exists($wiki, 'category_name')) : ?>
                            <span class="text-sm  mr-2">Category:</span>
                            <p class="text-white  p-1 rounded rounded-2 bg-gray-500"><?php echo $wiki->category_name; ?></p>
                        <?php endif; ?>
                    </div>


                    <!-- Display Tags -->


                    <div class="mt-2 flex flex-between w-full items-center">
                        <div class="flex w-full gap-2">
                            <span class="text-sm text-gray-500 mr-2">Tags:</span>
                            <p class="card-text text-white p-1 rounded rounded-2 bg-green-600">
                                #<?php echo implode('/', (array)$wiki->tags); ?></p>
                        </div>
                        <div class="p-2 w-full  flex justify-end">
                            <a href="<?php echo URLROOT; ?>/wikis/show/<?php echo $wiki->wiki_id; ?>" class="  text-black p-2  border-2 border-green-400 rounded-full hover:bg-green-400 hover:text-white">
                                Read More
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <!-- Display search results here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchResultsContainer = document.getElementById('searchResultsContainer');

        searchInput.addEventListener('input', function() {
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

            xhr.onload = function() {
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

            xhr.onerror = function() {
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
                <div class="container   mx-auto flex flex-col  items-center  mt-8">
                    <div class="w-1/2 w-full md:w-1/2 lg:w-1/3 xl:w-1/2 h-80   bg-white rounded-md overflow-hidden shadow-md transition-transform transform hover:scale-105 mb-4">
                        <div class="text-wrap flex flex-col w-full">
                        



                        <h2 class=" text-2xl font-bold mb-  w-4/5 text-gray-800 mt-0 px-4">${result.title}</h2>

                                
                        <div class="p-6 mt-12">
                        <p class="whitespace-normal w-full text-gray-600 mb-4  break-words overflow-hidden" style="text-overflow: ellipsis; white-space: nowrap;">${result.content}</p>
                                 <div class="flex items-center">
                                    <span class="text-sm  mr-2">Category:</span>
                                    <p class="text-white  p-1 rounded rounded-2 bg-gray-500">Category: ${result.category_name}</p>
                                </div>
                            
                       

                            <div class="mt-2 flex items-center">
                            <span class="text-sm text-gray-500 mr-2">Tags:</span>
                                <p class="card-text text-white p-1 rounded rounded-2 bg-green-600">Tags: ${result.tags || 'None'}</p>
                            </div>
                            
                        </div>

                    </div>
                </div>
                
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