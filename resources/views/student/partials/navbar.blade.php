<nav class="bg-white shadow-md">
    <div class="max-w-full mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-xl font-semibold text-gray-800">
                    Welcome, {{ auth()->user()->FirstName }}
                </span>
            </div>
            
            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                        <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ auth()->user()->FirstName }}+{{ auth()->user()->LastName }}" alt="Profile">
                        <span>{{ auth()->user()->FirstName }} {{ auth()->user()->LastName }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    
                    <!-- <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                        <a href="{{ route('student.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</nav>
