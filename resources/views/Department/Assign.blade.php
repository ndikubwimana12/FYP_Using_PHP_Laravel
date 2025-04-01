<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4">Assign Project</h2>
    
    <form action="{{ route('projects.assign') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2">Select Student</label>
                <select name="student_id" class="w-full border rounded p-2">
                    @foreach($students as $student)
                        <option value="{{ $student->StudentRegNumber }}">
                            {{ $student->FirstName }} {{ $student->LastName }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block mb-2">Select Supervisor</label>
                <select name="supervisor_id" class="w-full border rounded p-2">
                    @foreach($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}">
                            {{ $supervisor->FirstName }} {{ $supervisor->LastName }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-span-2">
                <label class="block mb-2">Project Title</label>
                <input type="text" name="project_title" class="w-full border rounded p-2">
            </div>
            
            <div class="col-span-2">
                <label class="block mb-2">Project Description</label>
                <textarea name="project_description" class="w-full border rounded p-2" rows="4"></textarea>
            </div>
            
            <div class="col-span-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Assign Project
                </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>