@props(['id','label','type','name','value' => [],'multiple' => false])
@php
    if (isset($value)) {
        $values = is_array($value)? $value:[$value];
    }
@endphp
<div class="mb-3 row">
    <label for="{{ $id }}" class="col-form-label col-sm-3 text-sm-end">{!! $label !!}</label>
    <div class="col-sm-9">
        <input type="file"
                {{ $attributes->merge(['class' => 'form-control']) }}
                id="{{ $id }}"
                name="{{ $name }}{{ $multiple? '[]':'' }}"
                {{ $multiple? 'multiple':'' }}
            >
    <span class="invalid-feedback font-weight-bold" role="alert" id="{{ $name }}-alert"><span>
    </div>
    <div class="col-sm-9 offset-3 ">
        <div class="row">
            <div class="col-max my-2">
                <h6 class="text-center">Uploaded</h6>
                <div class="row">
                    @foreach ($values as $k => $val)
                    @if ($val != '')
                        @php
                            if (!str_contains($val, 'storage')) {
                                $val = 'storage/'.$val;
                            }
                        @endphp
                    <div class="col-2">
                        <button type="button" class="text-danger btn btn-link position-absolute text-decoration-none font-weight-bolder">
                            <i class="fas fa-times-circle"></i>
                        </button>
                        <a href="{{ asset($val) }}" target="_blank" class="btn btn-link text-decoration-none font-weight-bolder">
                            <i class="fas fa-file-alt fa-5x"></i>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
