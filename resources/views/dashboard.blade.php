<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
    </x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Total Barang --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Total Barang</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="text-gray-400 dark:text-gray-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
        </div>

        {{-- Barang Dipinjam --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Barang Dipinjam</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $borrowedItems }}</p>
                </div>
                <div class="text-gray-400 dark:text-gray-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
            </div>
        </div>

        {{-- Barang Tersedia --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Barang Tersedia</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $availableProducts }}</p>
                </div>
                <div class="text-gray-400 dark:text-gray-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Total Kategori</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $totalCategories }}</p>
                </div>
                <div class="text-gray-400 dark:text-gray-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Secondary Stats Row --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Transaksi --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalBorrowings }}</p>
                </div>
                <div class="text-gray-400 dark:text-gray-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Stok Menipis</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $lowStockProducts->count() }}</p>
                </div>
                <div class="text-orange-500 dark:text-orange-400 opacity-85">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
            </div>
        </div>

        {{-- Barang Rusak --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition duration-150 ease-out">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wider text-gray-400 dark:text-gray-500 uppercase">Barang Rusak</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $damagedProducts }}</p>
                </div>
                <div class="text-red-500 dark:text-red-400 opacity-85">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Tren Peminjaman (Takes 2 cols) --}}
        <div class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200">Grafik Tren Peminjaman</h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Pergerakan total aktivitas peminjaman bulanan</p>
                    </div>
                    <span class="text-xs font-semibold text-black dark:text-white">12 Bulan Terakhir</span>
                </div>
                <div class="relative h-[220px] w-full">
                    <canvas id="borrowingChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Kondisi Barang (Takes 1 col) --}}
        <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-6">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200">Distribusi Kondisi</h3>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Pembagian kualitas aset barang inventaris</p>
                    </div>
                </div>
                <div class="relative h-[200px] w-full flex items-center justify-center">
                    <canvas id="conditionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Low Stock Alert --}}
    @if($lowStockProducts->count() > 0)
    <div class="bg-gradient-to-br from-white to-gray-50/30 dark:from-gray-800 dark:to-gray-800/40 rounded-2xl shadow-sm border border-orange-200/50 dark:border-orange-950/60 p-6">
        <h3 class="text-base font-bold text-gray-800 dark:text-gray-200 mb-4">
            Barang dengan Stok Menipis
        </h3>
        <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700/50">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 dark:text-gray-400 uppercase bg-gray-50/50 dark:bg-gray-800/50">
                    <tr><th class="px-4 py-3">Kode</th><th class="px-4 py-3">Nama Barang</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Stok</th><th class="px-4 py-3">Min. Stok</th><th class="px-4 py-3">Lokasi</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40">
                    @foreach($lowStockProducts as $product)
                    <tr class="hover:bg-gray-50/30 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-4 py-3.5 font-mono text-xs font-semibold text-gray-900 dark:text-white">{{ $product->code }}</td>
                        <td class="px-4 py-3.5 text-gray-700 dark:text-gray-300 font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-3.5 text-gray-500 dark:text-gray-400">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-3.5 text-gray-700 dark:text-gray-300 font-medium">{{ $product->stock }}</td>
                        <td class="px-4 py-3.5 text-gray-500 dark:text-gray-400">{{ $product->minimum_stock }}</td>
                        <td class="px-4 py-3.5 text-gray-600 dark:text-gray-300">{{ $product->storage_location }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDark = document.documentElement.classList.contains('dark');
            
            // 1. Line/Area Chart: Tren Peminjaman
            const ctxBorrowing = document.getElementById('borrowingChart').getContext('2d');
            
            // Create smooth gradient fill
            const redGradient = ctxBorrowing.createLinearGradient(0, 0, 0, 280);
            redGradient.addColorStop(0, isDark ? 'rgba(239, 68, 68, 0.25)' : 'rgba(220, 38, 38, 0.15)');
            redGradient.addColorStop(1, 'rgba(220, 38, 38, 0.0)');
            
            new Chart(ctxBorrowing, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: @json($chartValues),
                        fill: true,
                        backgroundColor: redGradient,
                        borderColor: '#DC2626',
                        borderWidth: 2.5,
                        tension: 0.35, // Smooth Bezier Curve
                        pointBackgroundColor: '#DC2626',
                        pointBorderColor: isDark ? '#1f2937' : '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#DC2626',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f3f4f6' : '#111827',
                            bodyColor: isDark ? '#d1d5db' : '#374151',
                            borderColor: isDark ? '#374151' : '#e5e7eb',
                            borderWidth: 1,
                            padding: 10,
                            boxPadding: 4,
                            usePointStyle: true,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: isDark ? '#9ca3af' : '#6b7280',
                                font: {
                                    family: 'Helvetica, Arial, system-ui, sans-serif',
                                    size: 11
                                }
                            },
                            grid: {
                                color: isDark ? 'rgba(75, 85, 99, 0.2)' : 'rgba(229, 231, 235, 0.8)',
                                drawBorder: false,
                                borderDash: [5, 5]
                            }
                        },
                        x: {
                            ticks: {
                                color: isDark ? '#9ca3af' : '#6b7280',
                                font: {
                                    family: 'Helvetica, Arial, system-ui, sans-serif',
                                    size: 11
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // 2. Doughnut Chart: Kondisi Barang
            const ctxCondition = document.getElementById('conditionChart').getContext('2d');
            const rawLabels = @json($conditionsLabels);
            const rawValues = @json($conditionsValues);
            
            // Strict custom order: Merah, Oren, Kuning, Abu
            const targetOrder = ['Rusak Berat', 'Rusak Ringan', 'Dalam Perbaikan', 'Baik'];
            
            const dataMap = {};
            rawLabels.forEach((label, index) => {
                dataMap[label] = rawValues[index];
            });
            
            const conditionLabels = [];
            const conditionValues = [];
            
            targetOrder.forEach(label => {
                if (dataMap.hasOwnProperty(label)) {
                    conditionLabels.push(label);
                    conditionValues.push(dataMap[label]);
                }
            });
            
            // Map adjusted Telkomsel-themed colorful palette
            const colorsMap = {
                'Baik': '#D1D5DB',           // Lighter Gray (Abu-abu lebih muda)
                'Rusak Ringan': '#F97316',    // Standard Vibrant Orange
                'Rusak Berat': '#EF4444',     // Bright Red
                'Dalam Perbaikan': '#FACC15'  // Bright Yellow
            };
            
            const backgroundColors = conditionLabels.map(label => colorsMap[label] || '#9CA3AF');

            new Chart(ctxCondition, {
                type: 'doughnut',
                data: {
                    labels: conditionLabels,
                    datasets: [{
                        data: conditionValues,
                        backgroundColor: backgroundColors,
                        borderWidth: isDark ? 2 : 1.5,
                        borderColor: isDark ? '#1f2937' : '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '45%', // Enlarge doughnut width (thicker ring / smaller center hole)
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: isDark ? '#d1d5db' : '#374151',
                                font: {
                                    family: 'Helvetica, Arial, system-ui, sans-serif',
                                    size: 11
                                },
                                boxWidth: 10,
                                padding: 6
                            }
                        },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f3f4f6' : '#111827',
                            bodyColor: isDark ? '#d1d5db' : '#374151',
                            borderColor: isDark ? '#374151' : '#e5e7eb',
                            borderWidth: 1,
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                    return ` ${context.label}: ${value} unit (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
