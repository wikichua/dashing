@props(['title' => ''])
<div {{ $attributes }}>
    <div class="card">
        @if (isset($title) && $title != '')
        <div class="card-header h4">
            {!! $title !!}
        </div>
        @endif
        <div class="card-body px-2">
            {!! $slot !!}
        </div>
    </div>
</div>
