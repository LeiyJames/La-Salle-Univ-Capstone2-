<div x-data="data">
    <div class="space-y-5">
        <div class="mx-auto ">
            <img src="{{ asset('assets/img/admin-carousel.jpg') }}" class="object-cover w-full h-auto" alt="Header Image">
        </div>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-gray-600 uppercase">Carousel</h1>
                <div class="flex items-center gap-3">
                    <a href="/admin" class="text-xs text-gray-400">Home</a>
                    <span class="text-xs text-gray-400">/</span>
                    <span class="text-xs text-blue-400">Carousel</span>
                </div>
            </div>

            @if (in_array(auth()->user()->users_role, ['admin']))
            <x-primary-button class="py-2.5" x-on:click="add_gallery_slider = true">
                <span class="w-full text-center">{{ __('Add new') }}</span>
            </x-primary-button>
            @endif
        </div>
        <div class="p-5 pt-3 space-y-5 bg-white rounded-2xl">
            @if (in_array(auth()->user()->users_role, ['admin']))
            <div class="overflow-y-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900"
                                width="25%">Photo</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Date
                                Uploaded</th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-900">Status
                            </th>
                            <th scope="col" class="uppercase relative py-3.5">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data as $gallery)
                        <tr>
                            <td class="py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <img src="{{ asset($gallery->getFirstMedia('gallery')->getUrl()) }}" class="w-auto h-14">
                            </td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $gallery->created_at }}</td>
                            <td class="py-4 text-sm text-gray-500 whitespace-nowrap">{{ $gallery->galleries_status ? 'Active' : 'Inactive' }}</td>
                            <td class="relative py-4 space-x-3 text-sm font-medium text-right whitespace-nowrap">
                                <a href="#" class="text-red-600 hover:text-red-900" wire:click="delete({{ $gallery->galleries_id }})">
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-4 text-sm text-center text-gray-500 whitespace-nowrap" colspan="6">
                                <span>No data available.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($data->hasPages())
            <div>
                {{ $data->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>



    @if (in_array(auth()->user()->users_role, ['admin']))
    @livewire('pages.admin.gallery.slider.create', ['slider' => 'add_gallery_slider'])
    @livewire('pages.admin.gallery.modal.delete', ['modal' => 'delete_gallery_modal'])
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('data', () => ({
                add_gallery_slider: false,
                delete_gallery_modal: @entangle('delete_gallery_modal')
            }))
        })
    </script>
</div>