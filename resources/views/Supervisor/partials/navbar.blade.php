<nav class="bg-white shadow-md">
    <div class="mx-auto px-6">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-semibold text-gray-800">
                    Welcome, {{ auth()->user()->name }}
                </span>
            </div>
            
            <div class="flex items-center">
                <div class="ml-3 relative">
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        
                        <div class="relative">
                            <button onclick="toggleProfileMenu()" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            
                            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('supervisor.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <a href="{{ route('supervisor.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');
    menu.classList.toggle('hidden');
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const menu = document.getElementById('profileMenu');
    const button = event.target.closest('button');
    if (!button && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
    }
});
</script>
