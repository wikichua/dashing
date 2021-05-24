@props(['disabled' => false, 'label','id'])
<div class="my-2">
    <label class="form-label" for="{{ $id }}">{{ $label ?? '' }}</label>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control filterInput']) !!} id="{{ $id }}">
</div>
