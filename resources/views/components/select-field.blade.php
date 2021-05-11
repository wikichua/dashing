@props(['id','label','type','name','selected','options'])
@php
	if (isset($selected) && !is_array($selected)) {
		$selected = [$selected];
	}
    $multiple = isset($attributes['multiple']) ? 'select-multiple':'select-one';
@endphp
<div class="mb-3 row">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => $multiple.' form-select form-select-sm col-max']) }}>
            @if (isset($attributes['multiple']))
            <option value=""></option>
            @endif
            @foreach($options as $key => $val)
            <option value="{{ $key }}" {{ isset($selected) && in_array($key, $selected)? 'selected':'' }}>{{ $val }}</option>
            @endforeach
        </select>
        <span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"></span>
    </div>
</div>
@push('scripts')
<script>
    let TomSelect_{{ $id }} = new TomSelect('#{{ $id }}',{
        allowEmptyOption: true,
        create: true
    });
</script>
@endpush
