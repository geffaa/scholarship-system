@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Pendaftaran Beasiswa</h2>

        <form action="{{ route('scholarships.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor HP -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input type="number" name="phone" value="{{ old('phone') }}" 
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150">
                    @error('phone')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Semester -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Semester</label>
                    <select name="semester" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150">
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                    @error('semester')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- IPK -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">IPK</label>
                    <div class="relative">
                        <input type="text" value="{{ number_format($ipk, 2) }}" disabled 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 font-medium text-gray-700">
                        <input type="hidden" name="ipk" value="{{ $ipk }}">
                    </div>
                </div>

                <!-- Jenis Beasiswa -->
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Beasiswa</label>
                    <select name="scholarship_id" 
                            {{ $ipk < 3 ? 'disabled' : '' }} 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-150 {{ $ipk < 3 ? 'bg-gray-50' : '' }}">
                        <option value="">Pilih Beasiswa</option>
                        @foreach($scholarships as $scholarship)
                            <option value="{{ $scholarship->id }}" 
                                    {{ (old('scholarship_id') == $scholarship->id || 
                                        (isset($selectedScholarship) && $selectedScholarship->id == $scholarship->id)) 
                                        ? 'selected' : '' }}>
                                {{ $scholarship->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('scholarship_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Berkas</label>
                    <div id="dropZone" class="relative mt-1 border-2 border-gray-300 border-dashed rounded-lg transition-colors duration-150 {{ $ipk < 3 ? 'bg-gray-50' : 'hover:border-blue-500' }}">
                        <!-- Upload Area -->
                        <div id="uploadArea" class="p-6">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4-4h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex flex-col items-center text-sm text-gray-600">
                                    <label for="document" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span id="fileNameDisplay">Upload file</span>
                                        <input id="document" name="document" type="file" class="sr-only" {{ $ipk < 3 ? 'disabled' : '' }}
                                            accept=".pdf,.jpg,.jpeg,.zip">
                                    </label>
                                    <p class="mt-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500" id="fileValidationMessage">PDF, JPG, atau ZIP hingga 2MB</p>
                            </div>
                        </div>

                        <!-- Preview Area -->
                        <div id="filePreviewArea" class="hidden p-6">
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-4">
                                    <div id="fileTypeIcon" class="text-gray-400">
                                        <!-- Icon will be injected by JavaScript -->
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900" id="previewFileName"></span>
                                        <span class="text-xs text-gray-500" id="previewFileSize"></span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="removeFile" 
                                            class="text-sm text-red-600 hover:text-red-800 focus:outline-none">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('document')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-span-2">
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed" 
                            {{ $ipk < 3 ? 'disabled' : '' }}>
                        Daftar Beasiswa
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi variabel
    const ipk = {{ number_format($ipk, 2, '.', '') }};
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('document');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileValidationMessage = document.getElementById('fileValidationMessage');
    const maxFileSize = 2 * 1024 * 1024; // 2MB
    const scholarshipSelect = document.querySelector('select[name="scholarship_id"]');

    console.log('Initial setup completed', { ipk, dropZone: !!dropZone, fileInput: !!fileInput });

    if (ipk >= 3) {
        // Jika beasiswa sudah terpilih, focus ke field berikutnya
        if (scholarshipSelect.value) {
            const documentInput = document.getElementById('document');
            if (documentInput) {
                documentInput.focus();
            }
        } else {
            // Jika belum terpilih, focus ke select beasiswa
            scholarshipSelect.focus();
        }
    }

    if (dropZone) {
        console.log('Initializing drag and drop handlers');

        // Prevent defaults for all drag events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            document.body.addEventListener(eventName, preventDefaults, false);
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Visual feedback saat drag
        function addHighlight() {
            console.log('Adding highlight to dropzone');
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
            // Tambahkan pesan visual
            fileNameDisplay.textContent = 'Lepaskan file di sini';
        }

        function removeHighlight() {
            console.log('Removing highlight from dropzone');
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
            // Kembalikan pesan default
            fileNameDisplay.textContent = 'Upload file';
        }

        // Counter untuk menangani dragenter/dragleave yang multiple
        let dragCounter = 0;

        // Drag Enter
        dropZone.addEventListener('dragenter', function(e) {
            console.log('Drag enter event');
            preventDefaults(e);
            dragCounter++;
            
            if (ipk >= 3) {
                addHighlight();
            }
        });

        // Drag Over
        dropZone.addEventListener('dragover', function(e) {
            console.log('Drag over event');
            preventDefaults(e);
            if (ipk >= 3) {
                addHighlight();
            }

            // Tambahkan visual cursor yang menandakan bisa di-drop
            e.dataTransfer.dropEffect = 'copy';
        });

        // Drag Leave
        dropZone.addEventListener('dragleave', function(e) {
            console.log('Drag leave event');
            preventDefaults(e);
            dragCounter--;
            
            // Hanya remove highlight jika benar-benar keluar dari area
            if (dragCounter === 0) {
                removeHighlight();
            }
        });

        // Drop
        dropZone.addEventListener('drop', function(e) {
            console.log('Drop event triggered');
            preventDefaults(e);
            dragCounter = 0;
            removeHighlight();

            if (ipk < 3) {
                console.log('Drop blocked - IPK < 3');
                return;
            }

            const dt = e.dataTransfer;
            const files = dt.files;

            console.log('Dropped files:', files);

            if (files.length > 1) {
                console.log('Multiple files dropped - taking only first file');
            }

            const file = files[0];
            if (file) {
                try {
                    fileInput.files = dt.files; // Update file input
                    handleFile(file);
                } catch (error) {
                    console.error('Error handling dropped file:', error);
                }
            }
        });

        // Tambahkan visual hint untuk drag & drop
        const uploadText = dropZone.querySelector('.text-center p');
        if (uploadText) {
            uploadText.innerHTML = `
                <span class="block mb-1">Drag & drop file di sini</span>
                <span class="block">atau klik untuk memilih file</span>
            `;
        }

        // Tambahkan class untuk menunjukkan area yang bisa di-drop
        dropZone.classList.add('cursor-pointer');
    }

    // Tambahkan indicator saat drag di luar zone
    document.body.addEventListener('dragover', function(e) {
        if (ipk >= 3) {
            e.preventDefault();
            e.stopPropagation();
            // Menunjukkan bahwa drop tidak diperbolehkan di luar zone
            e.dataTransfer.dropEffect = 'none';
        }
    });

    // Prevent drop di luar dropzone
    document.body.addEventListener('drop', function(e) {
        console.log('Drop outside dropzone');
        e.preventDefault();
        e.stopPropagation();
    });

    // Helper function untuk mendapatkan icon berdasarkan tipe file
    function getFileIcon(fileType) {
        const icons = {
            'application/pdf': `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 18H17V16H7V18Z" fill="currentColor"/>
                    <path d="M17 14H7V12H17V14Z" fill="currentColor"/>
                    <path d="M7 10H11V8H7V10Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z" fill="currentColor"/>
                </svg>`,
            'image/jpeg': `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 7C5.34315 7 4 8.34315 4 10C4 11.6569 5.34315 13 7 13C8.65685 13 10 11.6569 10 10C10 8.34315 8.65685 7 7 7ZM6 10C6 9.44772 6.44772 9 7 9C7.55228 9 8 9.44772 8 10C8 10.5523 7.55228 11 7 11C6.44772 11 6 10.5523 6 10Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 3C1.34315 3 0 4.34315 0 6V18C0 19.6569 1.34315 21 3 21H21C22.6569 21 24 19.6569 24 18V6C24 4.34315 22.6569 3 21 3H3ZM21 5H3C2.44772 5 2 5.44772 2 6V18C2 18.5523 2.44772 19 3 19H7.31374L14.1924 12.1213C15.364 10.9497 17.2835 10.9497 18.4551 12.1213L22 15.6662V6C22 5.44772 21.5523 5 21 5ZM21 19H10.1422L15.6066 13.5355C15.9971 13.145 16.6303 13.145 17.0208 13.5355L21.907 18.4217C21.7479 18.7633 21.4016 19 21 19Z" fill="currentColor"/>
                </svg>`,
            'application/zip': `<svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L6 8V20C6 21.1046 6.89543 22 8 22H16C17.1046 22 18 21.1046 18 20V8L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 2L6 8H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>`
        };

        // Default to PDF icon if type not found
        return icons[fileType] || icons['application/pdf'];
    }

    // Helper function untuk format ukuran file
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Function untuk menangani file
    function handleFile(file) {
        console.log('HandleFile called with:', file);
        
        if (!file) {
            console.error('No file provided');
            return false;
        }

        // Validasi tipe file
        const fileExtension = file.name.split('.').pop().toLowerCase();
        const validExtensions = ['pdf', 'jpg', 'jpeg', 'zip'];
        
        console.log('File validation:', {
            name: file.name,
            extension: fileExtension,
            size: file.size,
            type: file.type
        });

        if (!validExtensions.includes(fileExtension)) {
            console.error('Invalid file type:', fileExtension);
            fileValidationMessage.textContent = 'Error: File harus berformat PDF, JPG, atau ZIP';
            fileValidationMessage.classList.add('text-red-500');
            resetFileUpload();
            return false;
        }

        if (file.size > maxFileSize) {
            console.error('File too large:', file.size);
            fileValidationMessage.textContent = 'Error: Ukuran file tidak boleh lebih dari 2MB';
            fileValidationMessage.classList.add('text-red-500');
            resetFileUpload();
            return false;
        }

        console.log('File passed validation, showing preview');
        showFilePreview(file);
        return true;
    }

    // Function untuk menampilkan preview file
    function showFilePreview(file) {
        console.log('Showing preview for:', file.name);
        
        const uploadArea = document.getElementById('uploadArea');
        const previewArea = document.getElementById('filePreviewArea');
        const previewFileName = document.getElementById('previewFileName');
        const previewFileSize = document.getElementById('previewFileSize');
        const fileTypeIcon = document.getElementById('fileTypeIcon');
        
        console.log('Preview elements:', {
            uploadArea: !!uploadArea,
            previewArea: !!previewArea,
            previewFileName: !!previewFileName,
            previewFileSize: !!previewFileSize
        });

        if (!uploadArea || !previewArea || !previewFileName || !previewFileSize) {
            console.error('Required preview elements not found');
            return;
        }

        // Update preview content
        previewFileName.textContent = file.name;
        previewFileSize.textContent = formatFileSize(file.size);
        fileTypeIcon.innerHTML = getFileIcon(file.type);

        // Show preview, hide upload area
        uploadArea.classList.add('hidden');
        previewArea.classList.remove('hidden');
        
        console.log('Preview displayed successfully');
    }

    // Rest of the code (drag and drop handlers, etc.) remains the same...

    // Enhanced file input handler
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            console.log('File input change event');
            const file = e.target.files[0];
            if (file) {
                console.log('File selected through input:', file.name);
                handleFile(file);
            }
        });
    }

    function resetFileUpload() {
        console.log('Resetting file upload');
        const uploadArea = document.getElementById('uploadArea');
        const previewArea = document.getElementById('filePreviewArea');

        if (fileInput) fileInput.value = '';
        if (fileNameDisplay) fileNameDisplay.textContent = 'Upload file';
        if (fileValidationMessage) {
            fileValidationMessage.textContent = 'PDF, JPG, atau ZIP hingga 2MB';
            fileValidationMessage.classList.remove('text-red-500', 'text-green-500');
            fileValidationMessage.classList.add('text-gray-500');
        }

        if (uploadArea && previewArea) {
            uploadArea.classList.remove('hidden');
            previewArea.classList.add('hidden');
        }
    }

    // Reset button handler
    const removeFileBtn = document.getElementById('removeFile');
    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', function(e) {
            console.log('Remove file clicked');
            e.preventDefault();
            resetFileUpload();
        });
    }
});
</script>
@endpush
@endsection