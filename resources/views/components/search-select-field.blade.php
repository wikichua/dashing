@props(['disabled' => false, 'label','id','name','options' => []])
@php
    if (isset($attributes['multiple']) && !str_contains($name, '[]')) {
        $name = $name.'[]';
    }
@endphp
<div class="mt-2">
<label class="form-label" for="{{ $id }}">{{ $label ?? '' }}</label>
<select name="{{ $name }}" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' form-control filterInput col-max']) !!}>
    <option value="">Please Select</option>
    @foreach($options as $key => $val)
    <option value="{{ $key }}">{{ $val }}</option>
    @endforeach
</select>
</div>
@push('scripts')
<script>
    let TomSelect_search_{{ $id }} = new TomSelect('#{{ $id }}',{
        allowEmptyOption: true,
        create: true
    });
</script>
@endpush
