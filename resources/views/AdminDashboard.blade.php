<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FYP Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('admin.partials.admin-sidebar')


        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            @include('admin.partials.admin-navbar')


            <!-- Main Content Area -->
            <div class="flex-1 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Stats Cards -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Students</h3>
                                <p class="text-2xl font-semibold">250</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-500 rounded-full">
                                <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Supervisors</h3>
                                <p class="text-2xl font-semibold">45</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-500 rounded-full">
                                <i class="fas fa-project-diagram text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Active Projects</h3>
                                <p class="text-2xl font-semibold">120</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-building text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Departments</h3>
                                <p class="text-2xl font-semibold">8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 border-b">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user-plus text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700">New student registration</p>
                                <p class="text-sm text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 border-b">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-check text-green-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700">Project proposal approved</p>
                                <p class="text-sm text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-file-alt text-yellow-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700">New project submission</p>
                                <p class="text-sm text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.querySelector('.fa-bars').addEventListener('click', function() {
            document.querySelector('.bg-[#192841]').classList.toggle('-translate-x-full');
        });

        // Dropdown Toggle
        document.querySelector('.fa-chevron-down').addEventListener('click', function() {
            const dropdown = document.createElement('div');
            dropdown.className = 'absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1';
            dropdown.innerHTML = `
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
            `;

            const existingDropdown = document.querySelector('.absolute');
            if (existingDropdown) {
                existingDropdown.remove();
            } else {
                this.parentElement.appendChild(dropdown);
            }
        });
    </script>
</body>

</html>