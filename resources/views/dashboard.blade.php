@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Main Content -->
    <main class="lg:pl-72">
        <!-- Header -->
        <div class="px-6 py-4 bg-white shadow-sm border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-black font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Students -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-50">
                            <i class="fas fa-user-graduate text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Students</p>
                            <p class="text-2xl font-semibold text-gray-900">1,248</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">+12.5%</span>
                        <span class="text-gray-500 text-sm ml-2">from last month</span>
                    </div>
                </div>
            </div>

            <!-- Total Teachers -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-50">
                            <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Teachers</p>
                            <p class="text-2xl font-semibold text-gray-900">84</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">+3.2%</span>
                        <span class="text-gray-500 text-sm ml-2">from last month</span>
                    </div>
                </div>
            </div>

            <!-- Classes -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-50">
                            <i class="fas fa-door-open text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Active Classes</p>
                            <p class="text-2xl font-semibold text-gray-900">36</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">+2.1%</span>
                        <span class="text-gray-500 text-sm ml-2">from last month</span>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-50">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Monthly Revenue</p>
                            <p class="text-2xl font-semibold text-gray-900">$24,560</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">+8.7%</span>
                        <span class="text-gray-500 text-sm ml-2">from last month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Enrollment Chart -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Student Enrollment</h2>
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option>Last 7 days</option>
                        <option selected>Last 30 days</option>
                        <option>Last 90 days</option>
                    </select>
                </div>
                <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                    <!-- Placeholder for chart -->
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-line text-4xl mb-2"></i>
                        <p>Enrollment chart will appear here</p>
                    </div>
                </div>
            </div>

            <!-- Class Distribution -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Class Distribution</h2>
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option selected>By Grade</option>
                        <option>By Subject</option>
                        <option>By Teacher</option>
                    </select>
                </div>
                <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                    <!-- Placeholder for chart -->
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-pie text-4xl mb-2"></i>
                        <p>Distribution chart will appear here</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="p-6">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="px-5 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Activity Item -->
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-user-plus text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">New student enrolled</p>
                                <p class="text-sm text-gray-500">Sarah Johnson joined Grade 10</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity Item -->
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-money-check-alt text-blue-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Payment received</p>
                                <p class="text-sm text-gray-500">Michael Brown paid tuition fee</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity Item -->
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-award text-green-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Grades updated</p>
                                <p class="text-sm text-gray-500">Math midterm grades published</p>
                                <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity Item -->
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-purple-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">New event scheduled</p>
                                <p class="text-sm text-gray-500">Parent-teacher meeting on Friday</p>
                                <p class="text-xs text-gray-400 mt-1">2 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-3 border-t border-gray-200 text-center">
                    <a href="#" class="text-sm font-medium text-yellow-600 hover:text-yellow-700">View all activity</a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection