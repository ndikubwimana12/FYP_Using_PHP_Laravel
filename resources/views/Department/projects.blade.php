<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Department Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('department.partials.department-sidebar')

        <div class="flex-1 flex flex-col">
            @include('department.partials.department-navbar')

            <div class="flex-1 p-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Projects List</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Title</th>
                                    <th class="pb-3">Student</th>
                                    <th class="pb-3">Supervisor</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Progress</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr class="border-t">
                                    <td class="py-3">{{ $project->ProjectName }}</td>
                                    <td class="py-3">
                                        {{ $project->student->FirstName }} {{ $project->student->LastName }}
                                    </td>
                                    <td class="py-3">
                                        @if($project->student->supervision && $project->student->supervision->supervisor)
                                        {{ $project->student->supervision->supervisor->SupervisorFirstName }}
                                        {{ $project->student->supervision->supervisor->SupervisorLastName }}
                                        @else
                                        Not Assigned
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-sm
                {{ $project->status === 'approved' ? 'bg-green-100 text-green-800' :
                   ($project->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full"
                                                style="width: {{ $project->progress ?? 12 }}%">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <a href="#"
                                            class="text-blue-500 hover:text-blue-600">
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