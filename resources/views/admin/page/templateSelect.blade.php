<x-dashing::select-field name="template" id="template" label="Template" :options="[]" :selected="$model->template ?? ''"/>
@push('scripts')
@parent
<script>
$(function () {
    $(document).on('change','#brand_id',function() {
        let brand_id = $(this).val();
        axios.get(route('page.templates',brand_id)).then((response) => {
            TomSelect_template.clearOptions();
            TomSelect_template.addOption(response.data);
            @if (isset($model->template) && $model->template != '')
            TomSelect_template.addItem('{{ $model->template }}');
            @endif
        }).catch((error) => {
          console.error(error);
        }).finally(() => {

        });
    });
    $('#brand_id').trigger('change');
});
</script>
@endpush
