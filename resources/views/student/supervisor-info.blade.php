<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Information - Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('student.partials.sidebar')
        <div class="flex-1 flex flex-col">
            @include('student.partials.navbar')
            <div class="flex-1 p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold mb-6">Supervisor Information</h2>
    @if($supervision && $supervision->supervisor)
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <span class="font-medium">Name:</span>
                <p class="mt-1">{{ $supervision->supervisor->SupervisorFirstName }} {{ $supervision->supervisor->SupervisorLastName }}</p>
            </div>
            <div>
                <span class="font-medium">Email:</span>
                <p class="mt-1">{{ $supervision->supervisor->SupervisorEmail }}</p>
            </div>
            <div>
                <span class="font-medium">Department:</span>
                <p class="mt-1">{{ $supervision->supervisor->DepartmentCode }}</p>
            </div>
            <div>
                <span class="font-medium">Phone:</span>
                <p class="mt-1">{{ $supervision->supervisor->PhoneNumber }}</p>
            </div>
        </div>
    </div>
    @else
    <p class="text-gray-500">No supervisor has been assigned to you yet.</p>
    @endif
</div>

            </div>
        </div>
    </div>
</body>
</html>
