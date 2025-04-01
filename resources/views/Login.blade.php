<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FYP Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <script>
        window.onload = function() {
            selectRole('faculty');
        }
    </script>
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">
                FYP Management System
            </h2>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <!-- Role Selection Buttons -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Select Your Role
                    </label>
                    <div class="grid grid-cols-3 gap-4">
                        <button type="button" onclick="selectRole('admin')" id="adminBtn"
                            class="role-btn px-4 py-2 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 text-white">
                            Admin
                        </button>
                        <button type="button" onclick="selectRole('department')" id="departmentBtn"
                            class="role-btn px-4 py-2 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-blue-600 text-white">
                            Deartment
                        </button>
                        <button type="button" onclick="selectRole('student')" id="studentBtn"
                            class="role-btn px-4 py-2 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Student
                        </button>
                        <button type="button" onclick="selectRole('supervisor')" id="supervisorBtn"
                            class="role-btn px-4 py-2 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Supervisor
                        </button>

                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="role" id="selectedRole" value="faculty">

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" name="email" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input type="password" name="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Login
                        </button>
                    </div>
                    <div class="mt-6 text-center">
                        <span class="text-sm text-gray-600">Don't have an account?</span>
                        <a href="{{ route('signup') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium ml-1">
                            Create an account
                        </a>
                    </div>
                </form>

                @if ($errors->any())
                <div class="mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            // Remove active class from all buttons
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            // Add active class to selected button
            const selectedBtn = document.getElementById(role + 'Btn');
            selectedBtn.classList.remove('bg-white', 'text-gray-700');
            selectedBtn.classList.add('bg-blue-600', 'text-white');

            // Set the hidden input value
            document.getElementById('selectedRole').value = role;
        }
    </script>
</body>

</html>