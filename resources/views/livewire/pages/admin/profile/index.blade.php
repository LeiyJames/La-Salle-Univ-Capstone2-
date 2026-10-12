<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Admin Profile</h1>
            <p class="text-sm text-gray-500 mt-1">Manage your administrator account details and password settings.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                Role: {{ ucfirst(auth()->user()->users_role ?? 'admin') }}
            </span>
        </div>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 sm:p-8">
        <div class="max-w-xl">
            <livewire:profile.update-profile-information-form />
        </div>
    </div>

    <!-- Update Password Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 sm:p-8">
        <div class="max-w-xl">
            <livewire:profile.update-password-form />
        </div>
    </div>
</div>
