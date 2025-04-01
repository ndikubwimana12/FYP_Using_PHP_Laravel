<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - FYPMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <div class="w-[15%] bg-gray-900">
            <!-- Logo -->
            <div class="w-full bg-white">
                <h2 class="text-4xl font-medium py-[7px] text-gray-900 text-center">FYPMS</h2>
            </div>
           
            <!-- Search Container -->
            <div class="relative">
                <!-- Search Input -->
                <div class="flex justify-center items-center px-1 py-2">
                    <input type="text" id="searchInput" placeholder="Search a project" 
                           class="px-2 py-1 focus:outline-none rounded-full w-full">
                </div>
                
                <!-- Search Results -->
                <div id="searchResults" class="absolute right-[-300px] top-0 w-[300px] bg-white rounded-lg shadow-lg hidden">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Search Results</h3>
                        <div id="resultsContainer" class="space-y-2">
                            <!-- Results will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Navigation Links -->
            <div class="flex flex-col gap-3 pt-8 px-5">
                <a href="" class="text-white text-xl hover:text-blue-400 transition-colors">Dashboard</a>
                <a href="" class="text-white text-xl hover:text-blue-400 transition-colors">Project</a>
                <a href="" class="text-white text-xl hover:text-blue-400 transition-colors">Supervisor</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-[85%]">
            <!-- Navigation Bar -->
            <div class="w-full bg-gray-200 border-b-2 border-sky-500 py-3">
                <h3 class="ml-5 text-lg font-medium">Student-Dashboard</h3>
            </div>
           
            <!-- Main Content Area -->
            <div class="p-6">
                main content
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val();
                
                if (searchTerm.length > 0) {
                    // Show the results container
                    $('#searchResults').removeClass('hidden');
                    
                    // Simulate search results (replace with actual API call)
                    const results = [
                        { title: 'Project 1: ' + searchTerm },
                        { title: 'Project 2: ' + searchTerm },
                        { title: 'Project 3: ' + searchTerm }
                    ];
                    
                    // Update results
                    $('#resultsContainer').html(
                        results.map(result => 
                            `<div class="p-2 hover:bg-gray-100 rounded cursor-pointer">
                                ${result.title}
                            </div>`
                        ).join('')
                    );
                } else {
                    $('#searchResults').addClass('hidden');
                }
            });

            // Close results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchInput, #searchResults').length) {
                    $('#searchResults').addClass('hidden');
                }
            });
        });
    </script>
</body>
</html>
