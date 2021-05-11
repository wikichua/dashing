<x-dashing::select-field name="route_slug" id="route_slug" label="Route Slug / Name" :options="[]" :selected="$model->route_slug ?? ''"/>
@push('scripts')
@parent
<script>
$(function () {
    $(document).on('change','#brand_id',function() {
        let brand_id = $(this).val();
        axios.get(route('nav.pages',brand_id)).then((response) => {
            TomSelect_route_slug.clearOptions();
            TomSelect_route_slug.addOption(response.data);
            @if (isset($model->route_slug) && $model->route_slug != '')
            TomSelect_route_slug.addItem('{{ $model->route_slug }}');
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
