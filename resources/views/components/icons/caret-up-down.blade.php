@props(['fill' => '#000'])

<svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" {{ $attributes }}>
    <g id="caret-up-down-{{ md5(rand(0, 50)) }}-SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="caret-up-down-{{ md5(rand(0, 50)) }}-SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="caret-up-down-{{ md5(rand(0, 50)) }}-SVGRepo_iconCarrier">
        <g fill="{{ $fill }}">
            <path
                d="M8.55 2.24a.75.75 0 00-1.1 0L4.2 5.74a.75.75 0 101.1 1.02L8 3.852l2.7 2.908a.75.75 0 101.1-1.02l-3.25-3.5zM7.45 13.76a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02L8 12.148 5.3 9.24a.75.75 0 00-1.1 1.02l3.25 3.5z">
            </path>
        </g>
    </g>
</svg>