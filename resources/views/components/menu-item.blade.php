@php
	foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
<li class="sidebar-item"><a class="sidebar-link {{ $menuActive? 'active':'' }}" href="{{ $href }}">{{ $slot }}</a></li>
