@props(['id','label','name'])
<div class="py-3 row border-light border-top">
	<label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
	<div class="col-sm-9">
		<textarea {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id }}" name="{{ $name }}">
			{!! $value ?? '' !!}
		</textarea>
		<x-dashing::input-error name="{{ $name }}"/>
	</div>
</div>

@push('scripts')
<script>
$(function() {
    var simplemde_{{ $id }} = new SimpleMDE({ element: document.getElementById("{{ $id }}") });
});
</script>
@endpush
