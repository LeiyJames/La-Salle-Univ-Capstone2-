@props(['stroke' => '#000', 'fill' => '#000'])

<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" {{ $attributes }}>
    <g id="tag-{{ md5(rand(0, 5)) }}-SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="tag-{{ md5(rand(0, 5)) }}-SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="tag-{{ md5(rand(0, 5)) }}-SVGRepo_iconCarrier">
        <path stroke="{{ $stroke }}" stroke-linejoin="round" stroke-width="2"
            d="M3 10.95V6a1 1 0 011-1h4.95a1 1 0 01.707.293l7.636 7.636a1 1 0 010 1.415l-4.95 4.949a1 1 0 01-1.414 0l-7.636-7.636A1 1 0 013 10.948z">
        </path>
        <path stroke="{{ $stroke }}" stroke-linejoin="round" stroke-width="2"
            d="M15.636 20l5.657-5.656a1 1 0 000-1.415L13.363 5"></path>
        <circle cx="6.5" cy="8.5" r="1.5" fill="{{ $fill }}"></circle>
    </g>
</svg>