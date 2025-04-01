<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Supervisors - Department Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('department.partials.department-sidebar')

        <div class="flex-1 flex flex-col">
            @include('department.partials.department-navbar')

            <div class="flex-1 p-6">
                <!-- Page Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">Supervisor Assignment</h1>
                    <button onclick="openAssignModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-user-plus mr-2"></i>New Assignment
                    </button>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Unassigned Students</h3>
                                <p class="text-2xl font-semibold">{{ $unassignedStudents->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-full">
                                <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Available Supervisors</h3>
                                <p class="text-2xl font-semibold">{{ $supervisors->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Assignments</h3>
                                <p class="text-2xl font-semibold">{{ $totalAssignments }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Unassigned Students -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Unassigned Students</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left text-gray-500">
                                        <th class="pb-3">Reg Number</th>
                                        <th class="pb-3">Name</th>
                                        <th class="pb-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unassignedStudents as $student)
                                    <tr class="border-t">
                                        <td class="py-3">{{ $student->StudentRegNumber }}</td>
                                        <td class="py-3">{{ $student->FirstName }} {{ $student->LastName }}</td>
                                        <td class="py-3">
                                            <button onclick="openAssignModal('{{ $student->StudentRegNumber }}')"
                                                class="text-blue-600 hover:text-blue-800">
                                                Assign
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Supervisor Workload -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Supervisor Workload</h2>
                        <div class="space-y-4">
                            @foreach($supervisors as $supervisor)
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-700">{{ $supervisor->FirstName }} {{ $supervisor->LastName }}</span>
                                    <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                        {{ $supervisor->projects_count }} students
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                        style="width: {{ min(($supervisor->projects_count / 5) * 100, 100) }}%">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Assignment Modal -->
                <div id="assignModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Assign Supervisor</h3>
            <form action="{{ route('department.assign.supervisor') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" id="selectedStudent">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Select Supervisor</label>
                    <select name="supervisor_id" class="w-full border rounded-md px-3 py-2">
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}">
                                {{ $supervisor->SupervisorFirstName }} {{ $supervisor->SupervisorLastName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeAssignModal()" 
                            class="mr-2 px-4 py-2 text-gray-500 hover:text-gray-700">Cancel</button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>

    <script>
        function openAssignModal(studentId = null) {
            if (studentId) {
                document.getElementById('selectedStudent').value = studentId;
            }
            document.getElementById('assignModal').classList.remove('hidden');
        }

        function closeAssignModal() {
            document.getElementById('assignModal').classList.add('hidden');
        }
    </script>
</body>

</html>