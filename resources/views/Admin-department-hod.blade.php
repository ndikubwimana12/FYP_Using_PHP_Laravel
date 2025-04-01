<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Management - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Modal for Adding HOD -->
    <div id="addHODModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add New HOD</h3>
                <form id="hodForm" action="{{ route('hod.insert') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                        <input type="text" name="FirstName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                        <input type="text" name="LastName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Gender
                    </label>
                    <select name="Gender" required 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="Email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                        <input type="text" name="PhoneNumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                        @error('PhoneNumber')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                        <select name="DepartmentCode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('department_id') border-red-500 @enderror">
                            @foreach($departments as $department)
                                <option value="{{ $department->DepartmentCode }}">{{ $department->DepartmentName }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save HOD</button>
                        <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700">Cancel</button>
                    </div>
                    @if ($errors->any())
    1<div class="mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
                </form>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex">
        @include('admin.partials.admin-sidebar')

        <div class="flex-1">
            @include('admin.partials.admin-navbar')

            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">HOD Management</h1>
                    <button id="addHODBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Add New HOD
                    </button>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full table-auto">
        <thead class="bg-gradient-to-r from-blue-500 to-teal-500 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Department</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($hods as $hod)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">{{ $hod->FirstName .' '.$hod->LastName }}</td>
                    <td class="px-6 py-4">{{ $hod->Email }}</td>
                    <td class="px-6 py-4">{{ $hod->department->DepartmentName }}</td>
                    <td class="px-6 py-4">
                        <button class="text-blue-600 hover:text-blue-800 font-medium transition-all duration-200">Edit</button>
                        <button class="text-red-600 hover:text-red-800 font-medium transition-all duration-200">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('addHODBtn').onclick = () => {
            document.getElementById('addHODModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addHODModal').classList.add('hidden');
        }

        document.getElementById('addHODModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        @if($errors->any())
            document.getElementById('addHODModal').classList.remove('hidden');
        @endif
    </script>
</body>
</html>
