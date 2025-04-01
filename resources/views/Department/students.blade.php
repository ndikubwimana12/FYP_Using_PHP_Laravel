<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Department Dashboard</title>
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
                        <h2 class="text-xl font-semibold">Students List</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-3">Reg Number</th>
                                    <th class="pb-3">Name</th>
                                    <th class="pb-3">Project</th>
                                    <th class="pb-3">Supervisor</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr class="border-t">
                                    <td class="py-3">{{ $student->StudentRegNumber }}</td>
                                    <td class="py-3">{{ $student->FirstName }} {{ $student->LastName }}</td>
                                    <td class="py-3">{{ $student->project->ProjectTitle ?? 'No Project' }}</td>
                                    <td class="py-3">{{ $student->project->supervisor->FirstName ?? 'Not Assigned' }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            {{ $student->project->ProjectStatus ?? 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <a href="#" class="text-blue-500 hover:text-blue-600">View Details</a>
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
