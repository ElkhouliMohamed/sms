<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme color for mobile browsers -->
    <meta name="theme-color" content="#111827">
</head>

<body class="h-full bg-gray-50 antialiased">
    <!-- Mobile sidebar overlay -->
    <div id="overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden transition-opacity duration-300 lg:hidden"></div>

    <div class="flex h-full overflow-hidden">
        <!-- Sidebar (hidden on mobile by default) -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-30 w-72 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out h-full">
            @include('layouts.sidebar')
        </aside>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top navigation -->
            <header class="bg-white shadow-sm z-20">
                @include('layouts.navigation')
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50 focus:outline-none" tabindex="0">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile sidebar toggle button -->
    <button id="sidebarToggle" aria-label="Toggle sidebar" aria-expanded="false" aria-controls="sidebar"
        class="fixed lg:hidden bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-yellow-500 text-white shadow-lg flex items-center justify-center hover:bg-yellow-600 transition-colors">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const toggleSidebar = () => {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const toggleBtn = document.getElementById('sidebarToggle');
                
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
                
                // Update aria-expanded attribute
                const isExpanded = sidebar.classList.contains('-translate-x-full');
                toggleBtn.setAttribute('aria-expanded', !isExpanded);
                
                // Store preference in localStorage
                localStorage.setItem('sidebarCollapsed', isExpanded);
            };

            // Initialize sidebar state from localStorage
            const initializeSidebar = () => {
                if (window.innerWidth >= 1024) {
                    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    const sidebar = document.getElementById('sidebar');
                    if (isCollapsed) {
                        sidebar.classList.add('-translate-x-full');
                    } else {
                        sidebar.classList.remove('-translate-x-full');
                    }
                }
            };

            // Event listeners
            document.getElementById('sidebarToggle')?.addEventListener('click', toggleSidebar);
            document.getElementById('closeSidebar')?.addEventListener('click', toggleSidebar);
            document.getElementById('overlay')?.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking on nav items (mobile)
            document.querySelectorAll('#sidebar a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        toggleSidebar();
                    }
                });
            });

            // Add active class to current page link
            const currentPath = window.location.pathname;
            document.querySelectorAll('#sidebar a[href]').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    link.setAttribute('aria-current', 'page');
                }
            });

            // Initialize on load
            initializeSidebar();

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    document.getElementById('sidebar').classList.remove('-translate-x-full');
                    document.getElementById('overlay').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>