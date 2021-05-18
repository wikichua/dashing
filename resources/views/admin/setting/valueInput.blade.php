<x-dashing::checkbox-field name="multipleTypes" id="multipleTypes" label="Multiple values" :value="true" >Yes</x-dashing::checkbox-field>
<div class="mb-3 row">
    <label class="col-form-label col-sm-3 text-sm-end">Value</label>
    <div class="col-sm-9">
        <div class="form-control-plaintext h-auto">
            <div id="singleValue">
                <textarea name="value" id="value" class="form-control" rows="1">{{ isset($model->value) && !is_array($model->value)?  $model->value:'' }}</textarea>
            </div>
            <div id="multipleValues" style="display: none;">
                @if (isset($model->value) && is_array($model->value))
                    @foreach ($model->value as $index => $val)
                    <div class="row mb-1">
                        <div class="col-4 d-flex justify-content-center">
                            <input type="text" name="indexes[]" class="form-control" required placeholder="index" value="{{ $index }}">
                        </div>
                        <div class="col-7 d-flex justify-content-center">
                            <textarea type="text" name="values[]" class="form-control" placeholder="value" rows="1">{{ $val }}</textarea>
                        </div>
                        <div class="col-1 d-flex justify-content-end">
                            <div class="btn-group" role="group">
                                <button type="button" class="addRow btn btn-outline-primary"><i class="fa fa-plus"></i></button>
                                <button type="button" class="minusRow btn btn-outline-danger"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="row mb-1">
                    <div class="col-4 d-flex justify-content-center">
                        <input type="text" name="indexes[]" class="form-control" required placeholder="index">
                    </div>
                    <div class="col-7 d-flex justify-content-center">
                        <textarea type="text" name="values[]" class="form-control" placeholder="value" rows="1"></textarea>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <div class="btn-group" role="group">
                            <button type="button" class="addRow btn btn-outline-primary"><i class="fa fa-plus"></i></button>
                            <button type="button" class="minusRow btn btn-outline-danger"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script id="template" type="text/x-lodash-template">
<div class="row mb-1">
    <div class="col-4 d-flex justify-content-center">
        <input type="text" name="indexes[]" class="form-control" required placeholder="index">
    </div>
    <div class="col-7 d-flex justify-content-center">
        <textarea type="text" name="values[]" class="form-control" placeholder="value" rows="1"></textarea>
    </div>
    <div class="col-1 d-flex justify-content-end">
        <div class="btn-group" role="group">
            <button type="button" class="addRow btn btn-outline-primary"><i class="fa fa-plus"></i></button>
            <button type="button" class="minusRow btn btn-outline-danger"><i class="fa fa-minus"></i></button>
        </div>
    </div>
</div>
</script>
<script>
$(function () {
    $(document).on('click','.addRow',function() {
        var template = $('#template').html();
        var templateFn = _.template(template);
        var templateHTML = templateFn();
        $(this).closest('.row').after(templateHTML);
    });
    $(document).on('click','.minusRow',function() {
        if ($('#multipleValues').find('.row').length > 1) {
            $(this).closest('.row').remove();
        }
    });
    $(document).on('change', '#multipleTypes', function(event) {
        event.preventDefault();
        let isMultiple = $(this).is(':checked');
        if (isMultiple) {
            $('#singleValue').hide();
            $('#multipleValues').show();
        } else {
            $('#singleValue').show();
            $('#multipleValues').hide();
        }
    });
    @if (isset($model->value) && is_array($model->value))
        $('#multipleTypes').trigger('click');
    @endif
});
</script>
@endpush
