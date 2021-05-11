<x-dashing::app-layout>
    <x-slot name="header">
        Mailer Management - Preview
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <div class="table">
                <div class="row">
                    <div class="col">
                        <x-dashing::form ajax="true" method="POST" action="{{ route('mailer.preview',[$model->id]) }}" id="preview-form">
                            @foreach ($params as $param)
                            <x-dashing::textarea-field type="text" name="{{ $param }}" id="{{ $param }}" label="{{ $param }}" :value="request($param,'')"/>
                            @endforeach
                            <button type="submit" class="btn btn-primary">
                            Preview
                            </button>
                        </x-dashing::form>
                    </div>
                    <div class="col">
                        <h6>Preview</h6>
                        <div id="preview-div"></div>
                    </div>
                </div>
            </div>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('submit', '#preview-form', function(event) {
            event.preventDefault();
            let form = $(this);
            let action = form.attr('action');
            axios.post(action, new FormData(form[0])).then((response) => {
                $('#preview-div').html(response.data);
            });
        });
        $('#preview-form').trigger('submit');
    });
</script>
@endpush
</x-dashing::app-layout>
