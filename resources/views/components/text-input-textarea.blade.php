@props(['disabled' => false, 'cols' => 30, 'rows' => 10])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm py-1.5']) !!} cols="{{ $cols }}" rows="{{ $rows }}"></textarea>