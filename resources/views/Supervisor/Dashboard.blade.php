<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('supervisor.partials.sidebar')

        <div class="flex-1 flex flex-col">
            @include('supervisor.partials.navbar')

            <div class="flex-1 p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Active Supervisions</h3>
                                <p class="text-2xl font-semibold">{{ $activeSupervisions }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-full">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Completed Projects</h3>
                                <p class="text-2xl font-semibold">{{ $completedSupervisions }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <i class="fas fa-project-diagram text-purple-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-500 text-sm">Total Projects</h3>
                                <p class="text-2xl font-semibold">{{ $projects->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects List -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Current Projects</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Project Code</th>
                                    <th class="pb-3">Student Name</th>
                                    <th class="pb-3">Project Name</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectCode }}</td>
                                    <td class="py-3">{{ $project->student->FirstName }} {{ $project->student->LastName }}</td>
                                    <td class="py-3">{{ $project->ProjectName }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-sm 
                                            {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('supervisor.project.view', $project->ProjectCode) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            View Details
                                        </a>
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