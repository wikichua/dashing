@props(['label','options','id','input','name','type'])
@php
    $id = $id ?? uniqid();
    $options = collect($options)->toArray();
@endphp
<div class="py-3 row border-light border-top">
    <label class="col-form-label col-sm-3 text-sm-end">{{ $label ?? '' }}</label>
    <div class="col-sm-9">
        <div class="form-control-plaintext h-auto" id="multi-rows-{{ $id }}">
            @if (isset($options) && is_array($options))
                @foreach ($options as $index => $val)
                <div class="row mb-1">
                    <div class="col-11 d-flex justify-content-center">
                        @if ($type == 'textarea')
                        <textarea name="{{ $name }}[{{ $index }}]" {{ $attributes->merge(['class' => 'form-control']) }}>{{ $val }}</textarea>
                        @else
                        <input type="{{ $type }}" name="{{ $name }}[{{ $index }}]" {{ $attributes->merge(['class' => 'form-control']) }} value="{{ $val }}">
                        @endif
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <div class="btn-group" role="group">
                            <button type="button" class="addRow-{{ $id }} btn btn-outline-primary"><i class="fa fa-plus"></i></button>
                            <button type="button" class="minusRow-{{ $id }} btn btn-outline-danger"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <x-dashing::input-error name="{{ $name }}"/>
    </div>
</div>
@push('scripts')
<script id="template-{{ $id }}" type="text/x-lodash-template">
<div class="row mb-1">
    <div class="col-11 d-flex justify-content-center">
        @if ($type == 'textarea')
        <textarea name="{{ $name }}[]" {{ $attributes->merge(['class' => 'form-control']) }}></textarea>
        @else
        <input type="{{ $type }}" name="{{ $name }}[]" {{ $attributes->merge(['class' => 'form-control']) }} value="">
        @endif
    </div>
    <div class="col-1 d-flex justify-content-end">
        <div class="btn-group" role="group">
            <button type="button" class="addRow-{{ $id }} btn btn-outline-primary"><i class="fa fa-plus"></i></button>
            <button type="button" class="minusRow-{{ $id }} btn btn-outline-danger"><i class="fa fa-minus"></i></button>
        </div>
    </div>
</div>
</script>
<script>
$(function () {
    var template = $('#template-{{ $id }}').html();
    var templateFn = _.template(template);
    var templateHTML = templateFn();
    $(document).on('click','.addRow-{{ $id }}',function() {
        $(this).closest('.row').after(templateHTML);
    });
    $(document).on('click','.minusRow-{{ $id }}',function() {
        if ($('#multi-rows-{{ $id }}').find('.row').length > 1) {
            $(this).closest('.row').remove();
        }
    });
    @if (!isset($options) || !is_array($options) || count($options) < 1)
        $('#multi-rows-{{ $id }}').html(templateHTML);
    @endif
});
</script>
@endpush
