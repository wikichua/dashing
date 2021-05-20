<x-dashing::app-layout>
    <x-slot name="header">
        Mailer Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field name="mailable" id="mailable" label="Mailable" :value="$model->mailable" type="text"/>
            <x-dashing::display-field name="subject" id="subject" label="Subject" :value="$model->subject ?? ''" type="text"/>
            <x-dashing::display-field name="text_template" id="text_template" label="Plain Text" :value="$model->text_template ?? ''" type="text"/>
            <x-dashing::display-field name="html_template" id="html_template" label="HTML" :value="$model->html_template ?? ''" type="editor"/>
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
