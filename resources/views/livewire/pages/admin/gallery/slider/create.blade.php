<div>
    <x-sliders.default name="{{ $slider }}">
        <x-slot name="title">Upload Hero Carousel Banner</x-slot>
        <x-slot name="content">
            <div class="space-y-5 py-4">
                <!-- Session Error -->
                @if (session()->has('error'))
                    <div class="rounded-xl bg-red-50 border border-red-200 p-3.5 text-xs text-red-700 flex items-start gap-2.5">
                        <svg class="h-4 w-4 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Info note -->
                <div class="rounded-xl bg-blue-50 border border-blue-100 p-3.5 flex items-start gap-3">
                    <svg class="h-5 w-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <div class="text-xs text-blue-800">
                        <span class="font-semibold">Recommended Format:</span> Landscape 16:9 or 1920×800 px. Max file size: 10MB (JPG, PNG, WEBP). The banner will appear on the student portal homepage revolving carousel.
                    </div>
                </div>

                <!-- Photo Upload Field -->
                <div>
                    <x-input-label for="gallery-photo-input" :value="__('Banner Image')" class="mb-1 font-semibold text-gray-800" />
                    
                    <div class="mt-1">
                        <label for="gallery-photo-input" class="group relative flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-green-600 transition-colors bg-gray-50/50 hover:bg-green-50/20 cursor-pointer">
                            <div class="space-y-2 text-center pointer-events-none">
                                @if ($file && method_exists($file, 'temporaryUrl'))
                                    <div class="relative mx-auto rounded-xl overflow-hidden border border-gray-200 shadow-sm max-w-sm pointer-events-auto">
                                        <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="w-full h-36 object-cover">
                                        <div class="absolute bottom-2 right-2 bg-black/60 text-white text-[10px] px-2 py-0.5 rounded-full">
                                            Ready to upload
                                        </div>
                                    </div>
                                    <p class="text-xs font-bold text-green-700 group-hover:text-green-800">
                                        Click or tap anywhere here to choose a different image
                                    </p>
                                @else
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-green-600 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="text-xs text-gray-600">
                                        <span class="inline-block bg-white rounded-lg font-bold text-green-700 group-hover:text-green-800 px-3 py-1.5 shadow-sm border border-gray-200">
                                            Select Banner Image
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-gray-400">PNG, JPG, JPEG, WEBP up to 10MB</p>
                                @endif
                            </div>
                        </label>
                        <!-- Place file input outside label to prevent browser double-click cancellation -->
                        <input id="gallery-photo-input" wire:model="file" type="file" accept="image/*" class="sr-only">
                    </div>

                    <!-- Uploading Indicator -->
                    <div wire:loading wire:target="file" class="mt-2 text-xs text-green-700 font-medium flex items-center gap-2">
                        <svg class="animate-spin h-3.5 w-3.5 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Uploading image preview...</span>
                    </div>

                    @error('file')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Banner Placement Type -->
                <div>
                    <x-input-label :value="__('Placement Target')" class="mb-1 font-semibold text-gray-800" />
                    <x-text-input-select type="text" class="rounded-xl w-full bg-gray-50 border-gray-200 text-gray-700 text-xs py-2.5" wire:model="type" disabled>
                        <option value="carousel">Public Homepage Hero Carousel</option>
                    </x-text-input-select>
                    <span class="text-[11px] text-gray-400 mt-1 block">Assigned automatically to the public hero carousel.</span>

                    @error('type')
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="action">
            <x-secondary-button class="py-2.5" x-on:click="{{ $slider }} = false">
                <span class="w-full text-center">{{ __('Cancel') }}</span>
            </x-secondary-button>
            <x-primary-button class="py-2.5 bg-green-700 hover:bg-green-800 disabled:opacity-50" wire:click="save" wire:loading.attr="disabled" wire:target="file, save">
                <span wire:loading.remove wire:target="file, save" class="w-full text-center font-bold">{{ __('Upload & Publish') }}</span>
                <span wire:loading wire:target="file" class="w-full text-center font-bold">{{ __('Processing Image...') }}</span>
                <span wire:loading wire:target="save" class="w-full text-center font-bold">{{ __('Publishing...') }}</span>
            </x-primary-button>
        </x-slot>
    </x-sliders.default>
</div>