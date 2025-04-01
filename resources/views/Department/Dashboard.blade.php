<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Dashboard - FYP Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('department.partials.department-sidebar')

        <div class="flex-1 flex flex-col">
            @include('department.partials.department-navbar')

            <div class="flex-1 p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 rounded-full">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Students</h3>
                                <p class="text-2xl font-semibold">{{ $students->count() }}</p>
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
                                <p class="text-2xl font-semibold">{{ $supervisors->count() }}</p>
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
                                <p class="text-2xl font-semibold">{{ $activeProjects }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-500 rounded-full">
                                <i class="fas fa-clock text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Pending Projects</h3>
                                <p class="text-2xl font-semibold">{{ $pendingApprovals }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Projects Table -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Recent Projects</h2>
                        <a href="{{ route('department.projects') }}" class="text-blue-500 hover:text-blue-600">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Project Title</th>
                                    <th class="pb-3">Student</th>
                                    <th class="pb-3">Supervisor</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects->take(5) as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectTitle }}</td>
                                    <td class="py-3">{{ $project->student->FirstName }}</td>
                                    <td class="py-3">{{ $project->supervisor->FirstName }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            {{ $project->ProjectStatus }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <a href="#" class="text-blue-500 hover:text-blue-600">View Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        document.querySelector('.fa-bars')?.addEventListener('click', function() {
            document.querySelector('.bg-[#192841]').classList.toggle('-translate-x-full');
        });

        // Dropdown Toggle
        document.querySelector('.fa-chevron-down')?.addEventListener('click', function() {
            const dropdown = document.createElement('div');
            dropdown.className = 'absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1';
            dropdown.innerHTML = `
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                </form>
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
