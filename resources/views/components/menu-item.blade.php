@php
	foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
<li class="sidebar-item"><a class="sidebar-link {{ $menuActive? 'text-primary':'text-dark' }}" href="{{ $href }}">{{ $slot }}</a></li>
