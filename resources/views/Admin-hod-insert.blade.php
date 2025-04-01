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
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Computer Science</h3>
                        <div class="space-y-2">
                            <p class="text-gray-600">Students: 120</p>
                            <p class="text-gray-600">Supervisors: 15</p>
                            <p class="text-gray-600">Active Projects: 45</p>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
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