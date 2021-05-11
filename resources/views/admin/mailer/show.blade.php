<x-dashing::app-layout>
    <x-slot name="header">
        Mailer Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field name="mailable" id="mailable" label="Mailable" :value="$model->mailable" type="text"/>
            <x-dashing::display-field name="subject" id="subject" label="Subject" :value="$model->subject ?? ''" type="text"/>
            <x-dashing::display-field name="text_template" id="text_template" label="Plain Text" :value="$model->text_template ?? ''" type="text"/>
            <x-dashing::display-field name="html_template" id="html_template" label="HTML" :value="$model->html_template ?? ''" type="editor"/>
            <x-dashing::display-field type="text" name="created_at" id="created_at" label="Created At" :value="$model->created_at"/>
            <x-dashing::display-field type="text" name="created_by" id="created_by" label="Created By" :value="$model->creator->name"/>
            <x-dashing::display-field type="text" name="updated_at" id="updated_at" label="Updated At" :value="$model->updated_at"/>
            <x-dashing::display-field type="text" name="updated_by" id="updated_by" label="Updated By" :value="$model->modifier->name"/>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
