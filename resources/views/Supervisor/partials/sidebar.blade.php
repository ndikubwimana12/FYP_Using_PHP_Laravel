<div class="bg-[#192841] text-white w-64 min-h-screen flex flex-col transition-transform duration-300">
    <div class="p-4">
        <h2 class="text-2xl font-bold">Supervisor Panel</h2>
    </div>
    
    <nav class="flex-1 p-4">
        <a href="{{ route('supervisor.dashboard') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-tachometer-alt w-6"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('supervisor.students') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-user-graduate w-6"></i>
            <span>My Students</span>
        </a>
        
        <a href="{{ route('supervisor.projects') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-project-diagram w-6"></i>
            <span>Projects</span>
        </a>
        <a href="{{ route('supervisor.pending.projects') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-clock w-6"></i>
            <span>Pending Projects</span>
        </a>
        
        <a href="{{ route('supervisor.reports') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-chart-bar w-6"></i>
            <span>Reports</span>
        </a>
    </nav>
</div>

