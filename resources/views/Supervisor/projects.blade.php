<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Supervisor Dashboard</title>
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
                    <h2 class="text-xl font-semibold mb-4">Projects Under Supervision</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Project Code</th>
                                    <th class="pb-3">Project Name</th>
                                    <th class="pb-3">Student</th>
                                    <th class="pb-3">Progress</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectCode }}</td>
                                    <td class="py-3">{{ $project->ProjectName }}</td>
                                    <td class="py-3">{{ $project->student->FirstName }} {{ $project->student->LastName }}</td>
                                    <td class="py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('supervisor.project.view', $project->ProjectCode) }}" class="text-blue-600 hover:text-blue-800">View Details</a>
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
