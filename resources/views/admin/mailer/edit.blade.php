<x-dashing::app-layout>
    <x-slot name="header">
        Mailer Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('mailer.update',[$model->id]) }}">
                <x-dashing::textarea-field type="text" name="subject" id="subject" label="Subject" :value="$model->subject ?? ''"/>
                <x-dashing::textarea-field type="text" name="text_template" id="text_template" label="Plain Text Template" :value="$model->text_template ?? ''"/>
                <x-dashing::editor-field type="text" name="html_template" id="html_template" label="HTML Template" :value="$model->html_template ?? ''"/>
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''" />
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>

