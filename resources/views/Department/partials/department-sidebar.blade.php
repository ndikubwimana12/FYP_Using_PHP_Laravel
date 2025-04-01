<div class="bg-[#192841] text-white w-64 min-h-screen flex flex-col transition-transform duration-300">
    <div class="p-4">
        <h2 class="text-2xl font-bold">Department Panel</h2>
    </div>
    
    <nav class="flex-1 p-4">
        <a href="{{ route('department.dashboard') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-tachometer-alt w-6"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('department.supervisors') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-chalkboard-teacher w-6"></i>
            <span>Supervisors</span>
        </a>
        
        <a href="{{ route('department.students') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-user-graduate w-6"></i>
            <span>Students</span>
        </a>
        
        <a href="{{ route('department.assign.supervisors') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-user-plus w-6"></i>
            <span>Assign Supervisors</span>
        </a>

        <a href="{{ route('department.projects') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-project-diagram w-6"></i>
            <span>Projects</span>
        </a>
        
        <a href="{{ route('department.reports') }}" class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg mb-2">
            <i class="fas fa-chart-bar w-6"></i>
            <span>Reports</span>
        </a>
    </nav>
</div>
