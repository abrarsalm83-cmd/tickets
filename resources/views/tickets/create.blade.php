@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">➕ Create New Ticket</h1>
                <p class="text-gray-600 mt-1 text-sm">Create a new support ticket for customer assistance</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm border p-6">
                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" id="ticketForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client *</label>
                            <select id="client_id" name="client_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                required>
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}"
                                        {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select id="category_id" name="category_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-1">Assigned
                                To</label>
                            <select id="assigned_to" name="assigned_to"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">Unassigned</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority *</label>
                            <select id="priority" name="priority"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                required>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('priority')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject ID *</label>
                        <input type="text" id="subject_id" name="subject_id" value="{{ old('subject_id') }}"
                            placeholder="Enter subject identifier"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            required>
                        @error('subject_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="Brief description of the issue"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea id="message" name="message" rows="3" placeholder="Main message or issue description..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-y text-sm"
                            required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Additional
                            Description</label>
                        <textarea id="description" name="description" rows="3" placeholder="Additional details or context..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-y text-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- تحسين قسم رفع الملفات -->
                    <div class="mb-6">
                        <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">Attachments
                            (Optional)</label>

                        <!-- File Type Selection -->
                        <div class="mb-3">
                            <label class="block text-xs font-medium text-gray-600 mb-2">File Type:</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="file_type" value="images" class="form-radio text-blue-600"
                                        checked>
                                    <span class="ml-2 text-sm text-gray-700">Images Only</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="file_type" value="videos" class="form-radio text-blue-600">
                                    <span class="ml-2 text-sm text-gray-700">Videos Only</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="file_type" value="both"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2 text-sm text-gray-700">Images & Videos</span>
                                </label>
                            </div>
                        </div>

                        <!-- File Size Selection -->
                        <div class="mb-3">
                            <label for="max_file_size" class="block text-xs font-medium text-gray-600 mb-1">Maximum File
                                Size:</label>
                            <select id="max_file_size" name="max_file_size"
                                class="px-3 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="1">1 MB</option>
                                <option value="2" selected>2 MB</option>
                                <option value="5">5 MB</option>
                                <option value="10">10 MB</option>
                                <option value="25">25 MB (for videos)</option>
                                <option value="50">50 MB (for videos)</option>
                            </select>
                        </div>

                        <!-- File Input -->
                        <input type="file" id="attachments" name="attachments[]" multiple
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">

                        <!-- Dynamic help text -->
                        <div id="file-help-text" class="text-xs text-gray-500 mt-1">
                            You can select multiple images. Supported formats: JPEG, PNG, JPG, GIF (max 2MB each)
                        </div>

                        <!-- File preview area -->
                        <div id="file-preview" class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-2"></div>

                        @error('attachments.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('tickets.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors text-sm text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors text-sm">
                            Create Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileTypeRadios = document.querySelectorAll('input[name="file_type"]');
            const maxFileSizeSelect = document.getElementById('max_file_size');
            const attachmentsInput = document.getElementById('attachments');
            const fileHelpText = document.getElementById('file-help-text');
            const filePreview = document.getElementById('file-preview');

            // تحديث نوع الملفات المسموحة
            function updateFileAccept() {
                const selectedType = document.querySelector('input[name="file_type"]:checked').value;
                const maxSize = maxFileSizeSelect.value;

                let acceptTypes = '';
                let helpText = '';

                switch (selectedType) {
                    case 'images':
                        acceptTypes = 'image/jpeg,image/png,image/jpg,image/gif,image/webp';
                        helpText =
                            `Images only. Supported formats: JPEG, PNG, JPG, GIF, WEBP (max ${maxSize}MB each)`;
                        break;
                    case 'videos':
                        acceptTypes = 'video/mp4,video/avi,video/mov,video/wmv,video/webm';
                        helpText =
                            `Videos only. Supported formats: MP4, AVI, MOV, WMV, WEBM (max ${maxSize}MB each)`;
                        break;
                    case 'both':
                        acceptTypes =
                            'image/jpeg,image/png,image/jpg,image/gif,image/webp,video/mp4,video/avi,video/mov,video/wmv,video/webm';
                        helpText =
                            `Images and Videos. Supported formats: JPEG, PNG, JPG, GIF, WEBP, MP4, AVI, MOV, WMV, WEBM (max ${maxSize}MB each)`;
                        break;
                }

                attachmentsInput.setAttribute('accept', acceptTypes);
                fileHelpText.textContent = helpText;

                // مسح الملفات المحددة عند تغيير النوع
                attachmentsInput.value = '';
                filePreview.innerHTML = '';
            }

            // مراقبة تغييرات نوع الملف وحجم الملف
            fileTypeRadios.forEach(radio => {
                radio.addEventListener('change', updateFileAccept);
            });

            maxFileSizeSelect.addEventListener('change', updateFileAccept);

            // التحقق من حجم الملفات والمعاينة
            attachmentsInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const maxSizeMB = parseInt(maxFileSizeSelect.value);
                const maxSizeBytes = maxSizeMB * 1024 * 1024;
                const selectedType = document.querySelector('input[name="file_type"]:checked').value;

                filePreview.innerHTML = '';

                let validFiles = [];
                let hasError = false;

                files.forEach(file => {
                    // التحقق من حجم الملف
                    if (file.size > maxSizeBytes) {
                        alert(`File "${file.name}" is too large. Maximum size is ${maxSizeMB}MB.`);
                        hasError = true;
                        return;
                    }

                    // التحقق من نوع الملف
                    const isImage = file.type.startsWith('image/');
                    const isVideo = file.type.startsWith('video/');

                    if (selectedType === 'images' && !isImage) {
                        alert(`File "${file.name}" is not an image. Please select images only.`);
                        hasError = true;
                        return;
                    }

                    if (selectedType === 'videos' && !isVideo) {
                        alert(`File "${file.name}" is not a video. Please select videos only.`);
                        hasError = true;
                        return;
                    }

                    validFiles.push(file);

                    // إنشاء معاينة للملف
                    const previewDiv = document.createElement('div');
                    previewDiv.className =
                        'relative border border-gray-200 rounded-lg p-2 bg-gray-50';

                    if (isImage) {
                        const img = document.createElement('img');
                        img.className = 'w-full h-20 object-cover rounded';
                        img.src = URL.createObjectURL(file);
                        previewDiv.appendChild(img);
                    } else if (isVideo) {
                        const video = document.createElement('video');
                        video.className = 'w-full h-20 object-cover rounded';
                        video.src = URL.createObjectURL(file);
                        video.controls = true;
                        previewDiv.appendChild(video);
                    }

                    const fileName = document.createElement('p');
                    fileName.className = 'text-xs text-gray-600 mt-1 truncate';
                    fileName.textContent = file.name;
                    previewDiv.appendChild(fileName);

                    const fileSize = document.createElement('p');
                    fileSize.className = 'text-xs text-gray-500';
                    fileSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB`;
                    previewDiv.appendChild(fileSize);

                    filePreview.appendChild(previewDiv);
                });

                if (hasError) {
                    e.target.value = '';
                    filePreview.innerHTML = '';
                }
            });

            // التحقق من النموذج قبل الإرسال
            document.getElementById('ticketForm').addEventListener('submit', function(e) {
                const files = attachmentsInput.files;
                const maxSizeMB = parseInt(maxFileSizeSelect.value);
                const maxSizeBytes = maxSizeMB * 1024 * 1024;

                for (let file of files) {
                    if (file.size > maxSizeBytes) {
                        e.preventDefault();
                        alert(`Please ensure all files are under ${maxSizeMB}MB before submitting.`);
                        return;
                    }
                }
            });

            // تهيئة الإعدادات الأولية
            updateFileAccept();
        });
    </script>
@endsection
