@props(['id', 'name', 'label'])
<div class="py-3 row border-light border-top">
	<label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
	<div class="col-sm-9">
	<input type="text" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $id }}">
		<span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
	</div>
</div>
@push('scripts')
<script>
$(function() {
	let ${{ $id }} = $('#{{ $id }}').timepicker({ uiLibrary: 'bootstrap4', modal: true, showRightIcon: false });
	$(document).on('focus', '#{{ $id }}', function(event) {
		event.preventDefault();
		${{ $id }}.open();
	});
	$('.gj-datepicker>.input-group-append').remove();
});
</script>
@endpush
