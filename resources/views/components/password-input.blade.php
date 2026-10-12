@props(['disabled' => false])

<div x-data="{ show: false }" class="relative w-full">
    <input 
        type="password"
        :type="show ? 'text' : 'password'"
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->except('type')->merge(['class' => ($disabled ? 'bg-gray-100 cursor-not-allowed' : '') . ' border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-1.5 pr-10']) !!}
    >
    <button 
        type="button" 
        @click="show = !show" 
        tabindex="-1"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none cursor-pointer"
        title="Toggle password visibility"
        aria-label="Toggle password visibility"
    >
        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
        </svg>
    </button>
</div>
