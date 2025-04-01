<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Proposal - Student Dashboard</title>
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
                    <h2 class="text-xl font-semibold mb-6">Submit Project Proposal</h2>

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('student.submit.proposal') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Name</label>
                            <input type="text" name="ProjectName" value="{{ old('ProjectName') }}" class="w-full border rounded-lg p-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Problems</label>
                            <textarea name="ProjectProblems" rows="3" class="w-full border rounded-lg p-2" required>{{ old('ProjectProblems') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Solutions</label>
                            <textarea name="ProjectSolutions" rows="3" class="w-full border rounded-lg p-2" required>{{ old('ProjectSolutions') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Abstract</label>
                            <textarea name="ProjectAbstract" rows="4" class="w-full border rounded-lg p-2" required>{{ old('ProjectAbstract') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Dissertation</label>
                            <input type="file" name="ProjectDissertation" class="w-full border rounded-lg p-2" accept=".pdf,.doc,.docx" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Source Codes</label>
                            <input type="file" name="ProjectSourceCodes" class="w-full border rounded-lg p-2" accept=".zip,.rar" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Submit Project
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>