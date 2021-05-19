@props(['id','label','type','name','selected','options' => []])
@php
	if (isset($selected) && !is_array($selected)) {
		$selected = [$selected];
	}
    if (isset($attributes['multiple']) && !str_contains($name, '[]')) {
        $name = $name.'[]';
    }
@endphp
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-select form-select-sm col-max']) }}>
            @if (isset($attributes['multiple']))
            <option value="">Please Select</option>
            @endif
            @foreach($options as $key => $val)
            <option value="{{ $key }}" {{ isset($selected) && in_array($key, $selected)? 'selected':'' }}>{{ $val }}</option>
            @endforeach
        </select>
        <x-dashing::input-error name="{{ $name }}"/>
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
