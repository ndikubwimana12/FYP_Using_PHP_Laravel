<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Department Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('department.partials.department-sidebar')

        <div class="flex-1 flex flex-col">
            @include('department.partials.department-navbar')

            <div class="flex-1 p-6">
                <!-- Report Filters -->
                <!-- Report Filters -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Generate Custom Report</h2>
                    <form action="{{ route('department.generate.report') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                            <select name="date_range" class="w-full border rounded-lg p-2" required>
                                <option value="7">Last 7 Days</option>
                                <option value="30">Last 30 Days</option>
                                <option value="90">Last 3 Months</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                            <select name="report_type" class="w-full border rounded-lg p-2" required>
                                <option value="project_status">Project Status</option>
                                <option value="supervisor_workload">Supervisor Workload</option>
                                <option value="student_progress">Student Progress</option>
                                <option value="department_overview">Department Overview</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Export Format</label>
                            <select name="format" class="w-full border rounded-lg p-2" required>
                                <option value="PDF">PDF</option>
                                <option value="Excel">Excel</option>
                                <option value="CSV">CSV</option>
                            </select>
                        </div>

                        <div class="md:col-span-3 flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Generate Report
                            </button>
                        </div>
                    </form>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Project Status Overview -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Project Status Overview</h2>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach($projectStats as $stat)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ $stat->status }}</span>
                                <span class="font-semibold">{{ $stat->count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($stat->count / $projects->count()) * 100 }}%"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Supervisor Workload -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Supervisor Workload</h2>
                            <div class="flex space-x-2">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach($supervisors as $supervisor)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ $supervisor->FirstName }}</span>
                                <span class="font-semibold">{{ $supervisor->projects_count }} projects</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ ($supervisor->projects_count / $projects->count()) * 100 }}%"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>