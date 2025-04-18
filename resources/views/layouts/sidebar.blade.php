<aside id="sidebar"
    class="fixed h-screen lg:static inset-y-0 left-0 w-72 bg-gray-900 text-white shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out flex flex-col border-r border-gray-800">

    <!-- Sidebar Header -->
    <div class="p-5 border-b border-gray-800 flex items-center justify-between bg-gradient-to-r from-gray-900 to-gray-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center shadow-md">
                <i class="fas fa-school text-gray-900 text-lg"></i>
            </div>
            <h2 class="text-xl font-bold uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-300">
                EduManage Pro
            </h2>
        </div>
        <button id="closeSidebar" class="lg:hidden text-gray-400 hover:text-yellow-400 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- User Profile -->
    @auth
    <div class="p-4 border-b border-gray-800 flex items-center gap-3 bg-gray-850">
        <div class="relative">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center text-gray-900 font-bold shadow-md">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900 shadow-sm"></span>
        </div>
        <div class="overflow-hidden">
            <p class="font-semibold text-gray-100 truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400 truncate">
                {{ Auth::user()->role == 'admin' ? 'Administrator' : (Auth::user()->role == 'teacher' ? 'Teacher' : 'Student') }}
            </p>
        </div>
    </div>
    @endauth

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto py-4 px-2 custom-scrollbar">
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 mx-2
               {{ Request::routeIs('dashboard') ? 'bg-yellow-600 text-gray-900 shadow-md' : 'hover:bg-gray-800 hover:text-yellow-400' }}">
                <i class="fas fa-tachometer-alt text-lg w-6 text-center {{ Request::routeIs('dashboard') ? 'text-gray-900' : 'text-yellow-500 group-hover:text-yellow-400' }}"></i>
                <span class="font-medium">Dashboard</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity {{ Request::routeIs('dashboard') ? 'text-gray-900' : 'text-gray-500' }}"></i>
            </a>

            <!-- Section Title -->
            <div class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center">
                <span class="w-4 h-px bg-gray-700 mr-2"></span>
                Students & Parents
                <span class="w-4 h-px bg-gray-700 ml-2"></span>
            </div>
            
            <!-- Navigation Items -->
            @php
                $sections = [
                    'students' => ['icon' => 'user-graduate', 'title' => 'Students'],
                    'parents' => ['icon' => 'users', 'title' => 'Parents'],
                    'grades' => ['icon' => 'award', 'title' => 'Grades']
                ];
            @endphp
            
            @foreach($sections as $route => $data)
            <a href="{{ route($route . '.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 mx-2
               {{ Request::routeIs($route . '.*') ? 'bg-gray-800 text-yellow-400 border-l-4 border-yellow-500' : 'hover:bg-gray-800 hover:text-yellow-400' }}">
                <i class="fas fa-{{ $data['icon'] }} w-6 text-center {{ Request::routeIs($route . '.*') ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                <span>{{ $data['title'] }}</span>
                @if(Request::routeIs($route . '.*'))
                <div class="ml-auto w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                @endif
            </a>
            @endforeach

            <!-- Academic Section -->
            <div class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center">
                <span class="w-4 h-px bg-gray-700 mr-2"></span>
                Academic
                <span class="w-4 h-px bg-gray-700 ml-2"></span>
            </div>
            
            @php
                $academic = [
                    'teachers' => ['icon' => 'chalkboard-teacher', 'title' => 'Teachers'],
                    'classes' => ['icon' => 'door-open', 'title' => 'Classes'],
                    'subjects' => ['icon' => 'book-open', 'title' => 'Subjects'],
                    'matieres' => ['icon' => 'book', 'title' => 'Matieres'],
                    'payments' => ['icon' => 'money-bill-wave', 'title' => 'Payments']
                ];
            @endphp
            
            @foreach($academic as $route => $data)
            <a href="{{ route($route . '.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 mx-2
               {{ Request::routeIs($route . '.*') ? 'bg-gray-800 text-yellow-400 border-l-4 border-yellow-500' : 'hover:bg-gray-800 hover:text-yellow-400' }}">
                <i class="fas fa-{{ $data['icon'] }} w-6 text-center {{ Request::routeIs($route . '.*') ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                <span>{{ $data['title'] }}</span>
                @if(Request::routeIs($route . '.*'))
                <div class="ml-auto w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                @endif
            </a>
            @endforeach

            <!-- Administration Section -->
            <div class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center">
                <span class="w-4 h-px bg-gray-700 mr-2"></span>
                Administration
                <span class="w-4 h-px bg-gray-700 ml-2"></span>
            </div>
            
            @php
                $admin = [
                    'niveaux_scolaires' => ['icon' => 'layer-group', 'title' => 'Grade Levels'],
                    'emplois_du_temps' => ['icon' => 'calendar-alt', 'title' => 'Timetables']
                ];
            @endphp
            
            @foreach($admin as $route => $data)
            <a href="{{ route($route . '.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 mx-2
               {{ Request::routeIs($route . '.*') ? 'bg-gray-800 text-yellow-400 border-l-4 border-yellow-500' : 'hover:bg-gray-800 hover:text-yellow-400' }}">
                <i class="fas fa-{{ $data['icon'] }} w-6 text-center {{ Request::routeIs($route . '.*') ? 'text-yellow-400' : 'text-gray-400' }}"></i>
                <span>{{ $data['title'] }}</span>
                @if(Request::routeIs($route . '.*'))
                <div class="ml-auto w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                @endif
            </a>
            @endforeach
            
            <!-- Reports -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg mx-2 hover:bg-gray-800 hover:text-yellow-400 transition-all duration-200">
                <i class="fas fa-chart-bar w-6 text-center text-gray-400"></i>
                <span>Reports</span>
                <i class="fas fa-lock ml-auto text-xs text-gray-600"></i>
            </a>
        </nav>
    </div>

    <!-- Logout / Login -->
    <div class="p-4 border-t border-gray-800 bg-gray-850">
        @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-3 py-2.5 px-4 rounded-lg bg-gray-800 hover:bg-gray-700 hover:text-yellow-400 transition-all duration-200 group">
                <i class="fas fa-sign-out-alt text-gray-400 group-hover:text-yellow-400"></i>
                <span>Logout</span>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-600 group-hover:text-yellow-400"></i>
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" 
           class="w-full flex items-center justify-center gap-3 py-2.5 px-4 rounded-lg bg-gray-800 hover:bg-gray-700 hover:text-yellow-400 transition-all duration-200 group">
            <i class="fas fa-sign-in-alt text-gray-400 group-hover:text-yellow-400"></i>
            <span>Login</span>
            <i class="fas fa-chevron-right ml-auto text-xs text-gray-600 group-hover:text-yellow-400"></i>
        </a>
        @endauth
    </div>
</aside>

<!-- Mobile Toggle Button -->
<button id="toggleSidebar" 
        class="fixed lg:hidden bottom-6 right-6 z-40 w-14 h-14 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 text-gray-900 shadow-xl flex items-center justify-center hover:shadow-lg transition-all duration-300 group">
    <i class="fas fa-bars text-xl group-hover:rotate-90 transition-transform"></i>
</button>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(75, 85, 99, 0.3);
        border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(234, 179, 8, 0.5);
        border-radius: 3px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(234, 179, 8, 0.7);
    }
</style>

<script>
    // Toggle sidebar with animation
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        document.body.classList.toggle('overflow-hidden');
    });
    
    closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        document.body.classList.remove('overflow-hidden');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth < 1024 && !sidebar.contains(e.target) && e.target !== toggleBtn) {
            sidebar.classList.add('-translate-x-full');
            document.body.classList.remove('overflow-hidden');
        }
    });
</script>