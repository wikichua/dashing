@props(['id','label','name', 'value'])
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
	<textarea
		id="{{ $id }}"
		name="{{ $name }}"
		{{ $attributes->merge(['class' => 'form-control']) }}
        >{{ html_entity_decode($value ?? '') }}</textarea>
	<x-dashing::input-error name="{{ $name }}"/>
    </div>
</div>
