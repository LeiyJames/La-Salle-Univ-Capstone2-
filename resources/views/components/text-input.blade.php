@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ($disabled ? 'bg-gray-100 cursor-not-allowed' : '') . ' border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-1.5']) !!}>
