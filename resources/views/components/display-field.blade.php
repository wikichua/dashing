@props(['id','value' => '','label','type','name'])
@php
    if (!is_array($value) && !is_object($value))
    {
        $value = trim($value);
    }
@endphp
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <div class="form-control-plaintext">
        @switch($type)
            @case('date')
                {{ \Carbon\Carbon::parse(trim($value)) }}
                @break
            @case('image')
                @if (is_array($value))
                    @foreach ($value as $k => $v)
                        <li class="list-unstyled"><img src="{{ asset('storage/'.trim($v)) }}" style="max-height:50px;" /></li>
                    @endforeach
                @else
                <img src="{{ asset('storage/'.trim($value)) }}" style="max-height:50px;" />
                @endif
                @break
            @case('file')
                @if (is_array($value))
                    @foreach ($value as $k => $v)
                        <li class="list-unstyled"><a target="_blank" href="{{ asset('storage/'.trim($v)) }}">{{ trim($value) }}</a></li>
                    @endforeach
                @else
                <a target="_blank" href="{{ asset('storage/'.trim($value)) }}">{{ trim($value) }}</a>
                @endif
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
                @foreach ($value as $k => $v)
                    <li class="list-unstyled">{!! $k !!} : {!! is_array($v)? '<pre class="text-muted">'.(json_encode($v,JSON_PRETTY_PRINT)).'</pre>':$v !!}</li>
                @endforeach
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
