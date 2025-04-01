<nav class="bg-white shadow-md p-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <button class="text-gray-500 hover:text-gray-600 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-semibold ml-4">Welcome, {{ auth()->user()->FirstName }}</h1>
        </div>
        
        <div class="relative">
            <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                <span>{{ auth()->user()->FirstName }} {{ auth()->user()->LastName }}</span>
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    </div>
</nav>
