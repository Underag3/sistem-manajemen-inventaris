<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false', sidebarLoaded: false }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); if(val){document.documentElement.classList.add('dark')}else{document.documentElement.classList.remove('dark')} }); $watch('sidebarOpen', val => { localStorage.setItem('sidebarOpen', val); if(val){document.documentElement.classList.remove('sidebar-collapsed')}else{document.documentElement.classList.add('sidebar-collapsed')} }); setTimeout(() => sidebarLoaded = true, 50)">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            if (localStorage.getItem('sidebarOpen') === 'false' && window.innerWidth >= 1024) {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        </script>

        <style>
            /* Sidebar State */
            @media (min-width: 1024px) {
                html.sidebar-collapsed #sidebar-menu { width: 5rem !important; }
                html.sidebar-collapsed #main-content { margin-left: 5rem !important; }
                
                /* Hide texts and profile when collapsed */
                html.sidebar-collapsed .sidebar-text,
                html.sidebar-collapsed .sidebar-profile,
                html.sidebar-collapsed .sidebar-dropdown-icon { display: none !important; }
                
                /* Center items when collapsed */
                html.sidebar-collapsed #sidebar-menu .sidebar-header { justify-content: center !important; }
                html.sidebar-collapsed #sidebar-menu .nav-item { justify-content: center !important; padding-left: 0 !important; padding-right: 0 !important; }
                html.sidebar-collapsed #sidebar-menu .nav-item svg { margin-right: 0 !important; }
                html.sidebar-collapsed #sidebar-menu .nav-item > div { width: auto !important; justify-content: center !important; }
                
                /* Open state defaults */
                html:not(.sidebar-collapsed) #sidebar-menu .sidebar-header { justify-content: space-between; }
                html:not(.sidebar-collapsed) #sidebar-menu .nav-item { justify-content: flex-start; padding-left: 0.75rem; padding-right: 0.75rem; }
            }
        </style>

        <title>{{ config('app.name', 'Inventaris') }} - @yield('title', 'Dashboard')</title>



        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main Content --}}
            <div id="main-content" class="flex flex-col min-h-screen lg:ml-64" :class="sidebarLoaded ? 'transition-[margin] duration-300 ease-in-out' : ''">
                {{-- Top Navbar --}}
                @include('layouts.navbar')



                {{-- Flash Messages --}}
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    @if(session('success'))
                        <div x-data="{show: true}" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)" class="bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                {{ session('success') }}
                            </div>
                            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div x-data="{show: true}" x-show="show" x-transition class="bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ session('error') }}
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700">&times;</button>
                        </div>
                    @endif
                </div>

                {{-- Page Content --}}
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>

                {{-- Footer --}}
                <footer class="bg-red-600 dark:bg-red-700 text-white dark:text-red-100 py-4 px-6 text-center text-sm border-t border-red-700 dark:border-gray-800">
                    &copy; {{ date('Y') }} Sistem Manajemen Inventaris - PT Telkomsel
                </footer>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
