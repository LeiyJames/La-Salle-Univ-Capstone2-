<div>
    <x-sliders.default name="{{ $slider }}">
        <x-slot name="title">Edit User</x-slot>
        <x-slot name="content">
            @isset($user)
            <div class="py-3 space-y-3">
                <div>
                    <x-input-label for="user-organization-name" :value="__('Org/College Name')" class="mb-1" />
                    <x-text-input type="text" id="user-organization-name" class="w-full"  wire:model="user.users_organization_name" />

                    @error('user.users_organization_name')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="user-family-name" :value="__('Last Name')" class="mb-1" />
                    <x-text-input type="text" id="user-family-name" class="w-full"  wire:model="user.users_family_name" />

                    @error('user.users_family_name')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="user-given-name" :value="__('First Name')" class="mb-1" />
                    <x-text-input type="text" id="user-given-name" class="w-full"  wire:model="user.users_given_name" />

                    @error('user.users_given_name')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="user-email" :value="__('Email')" class="mb-1" />
                    <x-text-input type="email" id="user-email" class="w-full"  wire:model="user.users_email" />

                    @error('user.users_email')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="user-password" :value="__('Password')" class="mb-1" />
                    <x-text-input type="password" id="user-password" class="w-full" wire:model="user.users_password" />

                    @error('user.users_password')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="email" :value="__('Role')" class="mb-1" />
                    <x-text-input-select type="text" class="w-full rounded-2xl" wire:model="user.users_role" disabled="{{ true }}">
                        <option value="editor" selected>Editor</option>
                    </x-text-input-select>

                    @error('user.users_role')
                    <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @endisset
        </x-slot>
        <x-slot name="action">
            <x-secondary-button class="py-2.5" x-on:click="{{ $slider }} = false">
                <span class="w-full text-center">{{ __('Cancel') }}</span>
            </x-secondary-button>
            <x-primary-button class="py-2.5" wire:click="save">
                <span class="w-full text-center">{{ __('Save') }}</span>
            </x-primary-button>
        </x-slot>
    </x-sliders.default>
</div>
