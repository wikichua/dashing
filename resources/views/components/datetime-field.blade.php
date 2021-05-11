@props(['id', 'name', 'label'])
<div class="mb-3 row">
	<label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
	<div class="col-sm-9">
	<input type="text" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $id }}">
		<span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
	</div>
</div>
@push('scripts')
<script>
$(function() {
	$('#{{ $id }}').datetimepicker({ uiLibrary: 'bootstrap4', modal: true, header: true, footer: true, format: 'yyyy-mm-dd HH:MM', showRightIcon: false });
    $('.gj-datepicker>.input-group-append').remove();
});
</script>
@endpush

