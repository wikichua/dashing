@props(['disabled' => false, 'label','id'])
<div class="mt-2">
    <label class="form-label" for="{{ $id }}">{{ $label ?? '' }}</label>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control filterInput']) !!} id="{{ $id }}">
</div>
@push('scripts')
<script>
    $(function() {
        $('#{{ $id }}').daterangepicker({
            "autoUpdateInput": false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "alwaysShowCalendars": true
        });
        $('#{{ $id }}').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('#{{ $id }}').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
    });
</script>
@endpush
