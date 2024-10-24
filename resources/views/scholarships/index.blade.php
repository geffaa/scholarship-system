@extends('layouts.app')

@section('content')
<div class="bg-transparent">
    <!-- Hero Section -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Program Beasiswa</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Raih kesempatan untuk mengembangkan potensi akademik Anda melalui program beasiswa yang kami sediakan.
            </p>
        </div>
    </div>

    <!-- Scholarships List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="space-y-6">
            @foreach($scholarships as $scholarship)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-[1.02] hover:shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <!-- Card Header with Icon -->
                    <div class="bg-blue-600 md:w-72 p-6 flex items-center justify-center md:justify-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">{{ $scholarship->name }}</h2>
                    </div>

                    <!-- Card Content -->
                    <div class="flex-1 p-6">
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Requirements Section -->
                            <div class="md:col-span-2">
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Persyaratan
                                        </h3>
                                        <div class="mt-2 text-gray-600 prose">
                                            <p>{{ $scholarship->requirements }}</p>
                                        </div>
                                    </div>

                                    @if(isset($scholarship->benefits))
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            Manfaat
                                        </h3>
                                        <div class="mt-2 text-gray-600">
                                            <p>{{ $scholarship->benefits }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Application Button -->
                            <div class="flex items-center justify-center md:justify-end">
                                <a href="{{ route('scholarships.create', ['scholarship_id' => $scholarship->id]) }}" 
                                   class="inline-flex items-center justify-center bg-blue-600 text-white py-3 px-6 rounded-lg text-base font-medium hover:bg-blue-700 transition duration-150 group">
                                    Daftar Sekarang
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Information Section -->
        <div class="mt-16 bg-white rounded-xl shadow-lg p-8">
            <div class="text-center max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Informasi Penting</h3>
                <div class="grid md:grid-cols-3 gap-8 mt-8">
                    <div>
                        <div class="flex justify-center mb-4">
                            <span class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-lg font-semibold mb-2">Deadline Pendaftaran</h4>
                        <p class="text-gray-600">Pastikan mendaftar sebelum batas waktu yang ditentukan</p>
                    </div>
                    <div>
                        <div class="flex justify-center mb-4">
                            <span class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-lg font-semibold mb-2">Syarat IPK</h4>
                        <p class="text-gray-600">Minimal IPK 3.0 untuk seluruh program beasiswa</p>
                    </div>
                    <div>
                        <div class="flex justify-center mb-4">
                            <span class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-lg font-semibold mb-2">Periode Program</h4>
                        <p class="text-gray-600">Program berjalan selama satu semester akademik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection