<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetings - Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('supervisor.partials.sidebar')
        <div class="flex-1 flex flex-col">
            @include('supervisor.partials.navbar')
            <div class="flex-1 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Scheduled Meetings</h2>
                    <button onclick="openScheduleModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Schedule Meeting
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Upcoming Meetings</h3>
                        <div class="space-y-4">
                            @foreach($upcomingMeetings as $meeting)
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold">{{ $meeting->student->FirstName }} {{ $meeting->student->LastName }}</p>
                                        <p class="text-sm text-gray-500">{{ $meeting->date }} at {{ $meeting->time }}</p>
                                    </div>
                                    <button class="text-red-600 hover:text-red-800">Cancel</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Past Meetings</h3>
                        <div class="space-y-4">
                            @foreach($pastMeetings as $meeting)
                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold">{{ $meeting->student->FirstName }} {{ $meeting->student->LastName }}</p>
                                        <p class="text-sm text-gray-500">{{ $meeting->date }} at {{ $meeting->time }}</p>
                                    </div>
                                    <span class="text-green-600">Completed</span>
                                </div>
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
