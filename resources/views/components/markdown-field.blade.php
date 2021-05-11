@php
	foreach ($attributes as $key => $val) {
		$$key = $val;
	}
    $data = isset($data) && is_array($data)? $data:[];
@endphp
<div class="form-group">
	<label for="{{ $id }}">{!! $label !!}</label>
	<textarea class="form-control {{ implode(' ',$class) }}"
		id="{{ $id }}"
		name="{{ $name }}"
		@foreach (isset($attribute_tags)? $attribute_tags:[] as $attr_key => $attr_val)
			{{ $attr_key }} = "{{ $attr_val }}"
		@endforeach
		@foreach ($data as $data_key => $data_value)
            {{ 'data-'.$data_key }}="{{ $data_value }}"
        @endforeach
        >{!! $value ?? '' !!}</textarea>
	<span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
</div>

@push('scripts')
<script>
$(function() {
    var simplemde_{{ $id }} = new SimpleMDE({ element: document.getElementById("{{ $id }}") });
});
</script>
@endpush
