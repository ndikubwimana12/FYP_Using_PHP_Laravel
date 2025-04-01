<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-full h-screen bg-[#061937]">
        <div class="flex justify-between items-center max-w-6xl mx-auto py-2">
            <h1 class="text-white text-2xl font-bold">FYPM</h1>

            <div class="link">
                <!-- Navigation links here -->
            </div>

            <div class="btn space-x-4">


                <!-- <a href="{{ route('signup') }}"
                    class="border border-white px-4 py-2 rounded-full text-white hover:bg-white hover:text-[#061937] transition-colors">SignUp</a> -->
                <a href="{{ route('login') }}"
                    class="border border-white px-4 py-2 rounded-full text-white hover:bg-white hover:text-[#061937] transition-colors">SignIn</a>
            </div>
        </div>
        <!-- Main content section -->
        <div class="text-center mt-20 max-w-2xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-white">Welcome to FYPM</h2>
            <p class="text-lg text-white">Empowering the future of project management for students. Get started by
                signing up or
                signing in to your account.</p>
            <div class="mt-6 space-x-4">
                <a href="{{ route('signup') }}"
                    class="bg-white text-[#061937] hover:bg-gray-300 py-3 px-8 rounded-full font-semibold">Get
                    Started</a>

            </div>
        </div>
    </div>

</body>

</html>