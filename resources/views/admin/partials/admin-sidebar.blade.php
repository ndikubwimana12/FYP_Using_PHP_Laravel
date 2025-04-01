<div class="bg-[#192841] text-white w-64 py-6 flex flex-col">
    <div class="px-6 mb-8">
        <h2 class="text-2xl font-bold">FYP Admin</h2>
    </div>
    
    <nav class="flex-1">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-home mr-3"></i>Dashboard
            </a>
            <a href="{{ route('admin.departments') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.departments') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-building mr-3"></i>Departments
            </a>
            <a href="{{ route('admin.hod') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.hod') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-building mr-3"></i>HOD
            </a>

            <a href="{{ route('admin.supervisors') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.supervisors') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-chalkboard-teacher mr-3"></i>Supervisors
            </a>
            
            <a href="{{ route('admin.students') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.students') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-users mr-3"></i>Students
            </a>
            
            
            
            
            
            <a href="{{ route('admin.projects') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.projects') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-project-diagram mr-3"></i>Projects
            </a>
            
            <a href="{{ route('admin.settings') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.settings') ? 'bg-blue-600' : 'hover:bg-blue-600' }} transition-colors">
                <i class="fas fa-cog mr-3"></i>Settings
            </a>
        </div>
    </nav>

    <div class="px-6 py-4 border-t border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center text-gray-300 hover:text-white transition-colors">
                <i class="fas fa-sign-out-alt mr-3"></i>Logout
            </button>
        </form>
    </div>
</div>
