<div class="bg-[#192841] text-white w-64 min-h-screen flex flex-col transition-transform duration-300">
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-2xl font-bold">Student Portal</h2>
    </div>
    
    <nav class="flex-1 p-4">
        <div class="space-y-2">
            <a href="{{ route('student.dashboard') }}" 
               class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors">
                <i class="fas fa-home w-6"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('student.my-projects') }}" 
               class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors">
                <i class="fas fa-project-diagram w-6"></i>
                <span>My Projects</span>
            </a>

            <a href="{{ route('student.submit.proposal') }}" 
               class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors">
                <i class="fas fa-file-upload w-6"></i>
                <span>Submit Proposal</span>
            </a>

            <a href="{{ route('student.supervisor-info') }}" 
               class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors">
                <i class="fas fa-user-tie w-6"></i>
                <span>My Supervisor</span>
            </a>

            <a href="{{ route('student.search.projects') }}" 
               class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors">
                <i class="fas fa-search w-6"></i>
                <span>Search Projects</span>
            </a>
        </div>
    </nav>

    <div class="p-4 border-t border-gray-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center p-3 text-gray-300 hover:bg-blue-800 rounded-lg transition-colors w-full">
                <i class="fas fa-sign-out-alt w-6"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
