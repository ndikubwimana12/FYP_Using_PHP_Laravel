<div class="bg-white shadow-md h-16 flex items-center justify-between px-6">
    <div class="flex items-center">
        <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-600">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="ml-4">
            <h2 class="text-xl font-semibold text-gray-800">
                @yield('page-title', 'Dashboard')
            </h2>
        </div>
    </div>
    
    <div class="flex items-center space-x-4">
        <!-- Notifications -->
        <div class="relative">
            <button class="text-gray-500 hover:text-gray-600 relative">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                    3
                </span>
            </button>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button class="flex items-center space-x-3" @click="open = !open">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
                <span class="text-gray-700">Admin</span>
                <i class="fas fa-chevron-down text-gray-500"></i>
            </button>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden" id="profile-dropdown">
                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i>Profile
                </a>
                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle Profile Dropdown
    document.querySelector('.relative button').addEventListener('click', function() {
        document.getElementById('profile-dropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.relative')) {
            document.getElementById('profile-dropdown').classList.add('hidden');
        }
    });

    // Toggle Sidebar
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.bg-[#192841]').classList.toggle('-translate-x-full');
    });
</script>
