@props(['id','label','type','name','checked','value', 'disabled' => false])
<div class="py-3 row border-light border-top">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <div {{ $attributes->merge(['class' => "form-control-plaintext h-auto"]) }}>
            <label class="form-check">
                <input {{ $attributes->merge(['class' => 'form-check-input']) }} type="checkbox" value="{{ $value }}" name="{{ $name }}" id="{{ $id }}" {{ isset($checked) && ($value == $checked)? 'checked':'' }} {{ isset($disabled) && ($value == $disabled)? 'disabled':'' }}>
                <span class="form-check-label">
                    {{ $slot ?? '' }}
                </span>
            </label>
        </div>
    </div>
    <div>
        <span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
    </div>
</div>
