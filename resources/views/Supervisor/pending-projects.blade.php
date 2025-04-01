<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Projects - Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('supervisor.partials.sidebar')
        <div class="flex-1 flex flex-col">
            @include('supervisor.partials.navbar')
            <div class="flex-1 p-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Pending Project Approvals</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Project Code</th>
                                    <th class="pb-3">Student</th>
                                    <th class="pb-3">Project Name</th>
                                    <th class="pb-3">Description</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectCode }}</td>
                                    <td class="py-3">{{ $project->student->FirstName }} {{ $project->student->LastName }}</td>
                                    <td class="py-3">{{ $project->ProjectName }}</td>
                                    <td class="py-3">{{ $project->Description }}</td>
                                    <td class="py-3 flex space-x-2">
                                        <button onclick="approveProject('{{ $project->ProjectCode }}')"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                            Approve
                                        </button>
                                        <button onclick="openRejectModal('{{ $project->ProjectCode }}')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Reject
                                        </button>
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

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <form id="rejectForm" method="POST">
                @csrf
                <h3 class="text-lg font-medium mb-4">Reject Project</h3>
                <textarea name="reason" class="w-full border rounded p-2 mb-4" rows="3"
                    placeholder="Enter rejection reason"></textarea>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 text-gray-500 hover:text-gray-700">Cancel</button>
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function approveProject(projectCode) {
            if (confirm('Are you sure you want to approve this project?')) {
                window.location.href = `/supervisor/projects/${projectCode}/approve`;
            }
        }

        function openRejectModal(projectCode) {
            document.getElementById('rejectForm').action = `/supervisor/projects/${projectCode}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</body>

</html>