<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments Management - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Modal for Adding Department -->
    <div id="addDepartmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add New Department</h3>
                <form id="departmentForm" action="{{ route('department.insert') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Department Code</label>
                        <input type="text" name="Department_code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('Department_code') border-red-500 @enderror">
                        @error('Department_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Department Name</label>
                        <input type="text" name="DepartmentName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('DepartmentName') border-red-500 @enderror">
                        @error('DepartmentName')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Campus</label>
                        <select name="compus_id" id="compus_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('compus_id') border-red-500 @enderror">
                            @foreach($compuses as $compus)
                            <option value="{{ $compus->CampusId }}">{{ $compus->CampusName }}</option>
                            @endforeach
                        </select>
                        @error('compus_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between mt-6">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save Department</button>
    <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700">Cancel</button>
</div>

                    
                </form>


                <script>
                @if($errors -> any())
                
                    document.getElementById('addDepartmentModal').classList.remove('hidden');
                
                @endif
                </script>

            </div>
        </div>
    </div>

    <div class="min-h-screen flex">
        @include('admin.partials.admin-sidebar')

        <div class="flex-1">
            @include('admin.partials.admin-navbar')

            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">Departments Management</h1>
                    <button id="addDepartmentBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Add New Department
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Department Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-teal-500 rounded-xl shadow-2xl p-6 max-w-sm mx-auto transition-transform transform hover:scale-105">
    <h3 class="text-3xl font-bold text-white mb-4">Computer Science</h3>
    
    <!-- Information Section -->
    <div class="space-y-3 text-white opacity-80">
        <p class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
            <strong>Students:</strong> 120
        </p>
        <p class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
            <strong>Supervisors:</strong> 15
        </p>
        <p class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
            <strong>Active Projects:</strong> 45
        </p>
    </div>
    
    <!-- Action Buttons -->
    <div class="mt-6 flex space-x-4">
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-all transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 4v16M5 12l7-7 7 7"></path>
            </svg>
            Edit
        </button>
        <button class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-all transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18M6 6l12 12"></path>
            </svg>
            Delete
        </button>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addDepartmentBtn').onclick = () => {
            document.getElementById('addDepartmentModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addDepartmentModal').classList.add('hidden');
        }

        document.getElementById('addDepartmentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        
    </script>
</body>

</html>