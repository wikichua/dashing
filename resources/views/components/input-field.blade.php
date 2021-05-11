@props(['id','label','type','name'])
<div class="mb-3 row">
	<label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
	<div class="col-sm-9">
		<input type="{{ $type }}" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}">
		<span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"></span>
	</div>
</div>
