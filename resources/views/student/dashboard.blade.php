<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('student.partials.sidebar')
        <div class="flex-1 flex flex-col">
            @include('student.partials.navbar')
            <div class="flex-1 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Student Info -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">My Information</h2>
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium">Registration Number:</span>
                                <span>{{ $student->StudentRegNumber }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Name:</span>
                                <span>{{ $student->FirstName }} {{ $student->LastName }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Department:</span>
                                <span>{{ $student->DepartmentCode }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Supervisor Info -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">My Supervisor</h2>
                        @if($supervision)
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium">Name:</span>
                                <span>{{ $supervision->supervisor->FirstName }} {{ $supervision->supervisor->LastName }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Email:</span>
                                <span>{{ $supervision->supervisor->Email }}</span>
                            </div>
                        </div>
                        @else
                        <p class="text-gray-500">No supervisor assigned yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Projects -->
                <div class="mt-6 bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Recent Projects</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Project Name</th>
                                    <th class="pb-3">Submission Date</th>
                                    <th class="pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectName }}</td>
                                    <td class="py-3">{{ $project->created_at->format('d M Y') }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-sm 
                                            {{ $project->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($project->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
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
</body>

</html>