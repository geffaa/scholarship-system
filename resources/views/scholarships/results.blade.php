@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Hasil Pendaftaran Beasiswa</h2>
        <p class="mt-2 text-gray-600">Overview pendaftaran dan status beasiswa</p>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center h-full">
                <div class="w-2 h-full bg-blue-500"></div>
                <div class="flex items-center flex-1 p-6">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-blue-50 rounded-xl">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-gray-500">Total Pendaftar</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $applications->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Belum Diverifikasi -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center h-full">
                <div class="w-2 h-full bg-yellow-500"></div>
                <div class="flex items-center flex-1 p-6">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-yellow-50 rounded-xl">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-gray-500">Belum Diverifikasi</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">
                            {{ $applications->where('status', 'belum di verifikasi')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diterima -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center h-full">
                <div class="w-2 h-full bg-green-500"></div>
                <div class="flex items-center flex-1 p-6">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-green-50 rounded-xl">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-gray-500">Diterima</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">
                            {{ $applications->where('status', 'diterima')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex items-center h-full">
                <div class="w-2 h-full bg-red-500"></div>
                <div class="flex items-center flex-1 p-6">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-red-50 rounded-xl">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-gray-500">Ditolak</h3>
                        <p class="text-2xl font-bold text-gray-900 mt-1">
                            {{ $applications->where('status', 'ditolak')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Daftar Pendaftar Beasiswa</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor HP</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beasiswa</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berkas</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($applications as $application)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $application->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $application->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $application->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $application->semester }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-sm font-medium {{ $application->ipk >= 3 ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full">
                                {{ number_format($application->ipk, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $application->scholarship->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'belum di verifikasi' => 'bg-yellow-100 text-yellow-800',
                                    'diterima' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800',
                                ][$application->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-sm font-medium rounded-full {{ $statusClasses }}">
                                {{ ucwords($application->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ Storage::url($application->document_path) }}" 
                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-900"
                               target="_blank">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="mt-2 text-sm">Belum ada pendaftaran beasiswa.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection