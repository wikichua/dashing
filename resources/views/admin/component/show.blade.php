<x-dashing::app-layout>
    <x-slot name="header">
        Component Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <div class="row">
                <div class="col">
                    <x-dashing::form ajax="true" method="POST" action="{{ route('component.try',[$model->id]) }}" id="component-try-form">
                        <x-dashing::textarea-field name="code" id="code" label="Try It" value="<x-{{ strtolower($model->brand->name) }}::{{ \Str::kebab($model->name) }}></x-{{ strtolower($model->brand->name) }}::{{ \Str::kebab($model->name) }}>"/>
                        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
                    </x-dashing::form>
                </div>
                <div class="col">
                    <h6>Preview</h6>
                    <div id="preview-div"></div>
                </div>
            </div>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
   $(document).ready(function() {
    $(document).on('submit', '#component-try-form', function(event) {
        event.preventDefault();
        let form = $(this);
        let action = form.attr('action');
        axios.post(action, new FormData(form[0])).then((response) => {
            $('#preview-div').html(response.data);
        });
    });
    $('#component-try-form').trigger('submit');
});
</script>
@endpush
</x-dashing::app-layout>
