{{-- Sidebar Overlay for Mobile --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:leave="transition-opacity ease-linear duration-300"></div>

{{-- Sidebar --}}
<aside id="sidebar-menu" class="fixed inset-y-0 left-0 z-30 -translate-x-full lg:translate-x-0 w-64 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-200 border-r border-gray-200 dark:border-gray-800 flex flex-col shadow-sm" :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0', sidebarLoaded ? 'transition-[width,transform] duration-300 ease-in-out' : '']">
    {{-- Logo --}}
    <div class="sidebar-header flex items-center h-16 px-4 border-b border-gray-200 dark:border-gray-800 justify-between">
        <a href="{{ route('dashboard') }}" class="sidebar-text flex items-center space-x-2">
            <svg class="w-8 h-8 text-red-600 dark:text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <span class="text-lg font-bold text-gray-900 dark:text-white">Inventaris</span>
        </a>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 lg:block hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 lg:hidden" x-show="sidebarOpen">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- User Info --}}
    <div class="sidebar-profile px-4 py-3 border-b border-gray-200 dark:border-gray-800">
        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->role->name ?? 'User' }}</p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <a href="{{ route('dashboard') }}" class="nav-item flex items-center py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="sidebar-text">Dashboard</span>
        </a>

        @if(Auth::user()->hasRole('Admin', 'Staff'))
        <a href="{{ route('categories.index') }}" class="nav-item flex items-center py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('categories.*') ? 'bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
            <span class="sidebar-text">Kategori</span>
        </a>
        @endif

        <a href="{{ route('products.index') }}" class="nav-item flex items-center py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <span class="sidebar-text">Barang</span>
        </a>

        @if(Auth::user()->hasRole('Admin', 'Staff'))
        <a href="{{ route('borrowings.index') }}" class="nav-item flex items-center py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('borrowings.*') ? 'bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            <span class="sidebar-text">Peminjaman</span>
        </a>
        @endif

        @if(Auth::user()->hasRole('Admin', 'Manager'))
        <div x-data="{ open: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }">
            <button @click="if(!sidebarOpen) { sidebarOpen = true; open = true; } else { open = !open }" class="nav-item w-full flex items-center justify-between py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('reports.*') ? 'bg-red-50 text-red-600 dark:bg-red-950/20 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                <div class="flex items-center w-full justify-center lg:justify-start">
                    <svg class="w-5 h-5 flex-shrink-0 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="sidebar-text">Laporan</span>
                </div>
                <svg :class="open ? 'rotate-90' : ''" class="sidebar-dropdown-icon w-4 h-4 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div x-show="open" x-transition class="sidebar-text ml-8 mt-1 space-y-1" style="display: {{ request()->routeIs('reports.*') ? 'block' : 'none' }}">
                <a href="{{ route('reports.products') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('reports.products*') ? 'bg-red-50 text-red-600 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-white' }}">Laporan Barang</a>
                <a href="{{ route('reports.borrowings') }}" class="block px-3 py-2 rounded-lg text-sm {{ request()->routeIs('reports.borrowings*') ? 'bg-red-50 text-red-600 dark:text-red-400 font-semibold' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-white' }}">Laporan Peminjaman</a>
            </div>
        </div>
        @endif
    </nav>

</aside>
