@props(['disabled' => false, 'label','id','options' => []])
<div class="mt-2">
<label class="form-label" for="{{ $id }}">{{ $label ?? '' }}</label>
<select id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' form-control filterInput col-max']) !!} id="{{ $id }}" multiple>
    <option value="">Please Select</option>
    @foreach($options as $key => $val)
    <option value="{{ $key }}">{{ $val }}</option>
    @endforeach
</select>
</div>
@push('scripts')
<script>
    let TomSelect_search_{{ $id }} = new TomSelect('#{{ $id }}',{
        allowEmptyOption: true,
        create: true
    });
</script>
@endpush
