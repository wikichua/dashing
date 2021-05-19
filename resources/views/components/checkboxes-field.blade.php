@props(['id','label','type','name','checked','options', 'isGroup' => false,'disabled' => false, 'inline' => false])
@php
	if (isset($checked) && !is_array($checked)) {
		$checked = [$checked];
	}
    if ($isGroup) {
        $groupOptions = $options;
    }
    $inline = $inline ? 'form-check-inline' : '';
    $disabled = $disabled ? 'disabled' : '';
@endphp
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <div {{ $attributes->merge(['class' => "form-control-plaintext h-auto"]) }}>
            @if ($isGroup)
                @foreach ($groupOptions as $group => $options)
                <b class="d-block{{ !$loop->first ? ' mt-3' : '' }}">{{ $group }}</b>
                <div>
                    @foreach($options as $key => $val)
                    <label class="form-check {{ $inline ?? '' }}" for="{{ $id }}-{{ $key }}">
                        <input class="form-check-input" type="checkbox" name="{{ $name }}[{{ $key }}]" id="{{ $id }}-{{ $key }}" value="{{ $key }}" {{ isset($checked) && in_array($key, $checked)? 'checked':'' }} {{ $disabled ?? '' }}>
                        <span class="form-check-label">
                            {{ $val }}
                        </span>
                    </label>
                    @endforeach
                </div>
                @endforeach
            @else
                @foreach($options as $key => $val)
                <label class="form-check {{ $inline ?? '' }}" for="{{ $id }}-{{ $key }}">
                    <input class="form-check-input" type="checkbox" name="{{ $name }}[{{ $key }}]" id="{{ $id }}-{{ $key }}" value="{{ $key }}" {{ isset($checked) && in_array($key, $checked)? 'checked':'' }} {{ $disabled ?? '' }}>
                    <span class="form-check-label">
                        {{ $val }}
                    </span>
                </label>
                @endforeach
            @endif
        </div>
        <div>
            <span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
        </div>
    </div>
</div>
