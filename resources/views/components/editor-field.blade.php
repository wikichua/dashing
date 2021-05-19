@props(['id','label','name','value'])
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
    	<textarea
    		id="{{ $id }}"
    		name="{{ $name }}"
            {{ $attributes->merge(['class' => 'form-control']) }}
            >{!! $value ?? '' !!}</textarea>
    	<span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
    </div>
</div>

@push('scripts')
<script>
$(function() {
    $('#{{ $id }}').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        callbacks: {
            onInit: function() {
                @if (isset($codeview) && $codeview == true)
                $("div.note-editor button.btn-codeview").click();
                @endif
            },
            onImageUpload: function(files) {
                let file = files[0];
                onImageUpload(files[0],$(this));
            }
        }
    });
});
</script>
@endpush
