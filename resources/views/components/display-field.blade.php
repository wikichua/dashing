@props(['id','value','label','type','name'])
@php
	$value = isset($value)? $value:'';
    if (!is_array($value) && !is_object($value))
    {
        $value = trim($value);
    }
@endphp
<div class="mb-3 row">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <div class="form-control-plaintext">
        @switch($type)
            @case('date')
                {{ \Carbon\Carbon::parse(trim($value)) }}
                @break
            @case('image')
                @if (is_array($value))
                    @forelse ($value as $k => $v)
                        <li class="list-unstyled"><img src="{{ asset(trim($v)) }}" style="max-height:50px;" /></li>
                    @empty
                        Null
                    @endforelse
                @endif
                <img src="{{ asset(trim($value)) }}" style="max-height:50px;" />
                @break
            @case('file')
                @if (is_array($value))
                    @forelse ($value as $k => $v)
                        <li class="list-unstyled"><a target="_blank" href="{{ asset(trim($v)) }}">{{ trim($value) }}</a></li>
                    @empty
                        Null
                    @endforelse
                @endif
                <a target="_blank" href="{{ asset(trim($value)) }}">{{ trim($value) }}</a>
                @break
            @case('editor')
                {!! trim($value) !!}
                @break
            @case('markdown')
                {!! markdown($value) !!}
                @break
            @case('list')
                {!! implode('<br>', $value) !!}
                @break
            @case('json') {{-- special for key-paired --}}
                @forelse ($value as $k => $v)
                    <li class="list-unstyled">{!! $k !!} : {!! is_array($v)? '<pre class="text-muted">'.(json_encode($v,JSON_PRETTY_PRINT)).'</pre>':$v !!}</li>
                @empty
                    Null
                @endforelse
                @break
            @case('code')
                    @if (!is_array($value) && json_decode($value))
                    <pre class="text-muted">@json(json_decode($value), JSON_PRETTY_PRINT)</pre>
                    @elseif(is_array($value))
                    <pre class="text-muted">@json($value, JSON_PRETTY_PRINT)</pre>
                    @else
                    <pre class="text-muted">{!! $value !!}</pre>
                    @endif
                @break
            @default
                @if (is_array($value))
                {!! implode(',', $value) !!}
                @else
                {!! $value !!}
                @endif
        @endswitch
        </div>
</div>
</div>
