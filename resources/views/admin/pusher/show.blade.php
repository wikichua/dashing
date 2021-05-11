<x-dashing::app-layout>
    <x-slot name="header">
        Nav Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id"/>
            <x-dashing::display-field type="text" name="title" id="title" label="Title" :value="$model->title"/>
            <x-dashing::display-field type="text" name="locale" id="locale" label="Locale" :value="$model->locale"/>
            <x-dashing::display-field type="text" name="message" id="message" label="Message" :value="$model->message"/>
            <x-dashing::display-field type="text" name="event" id="event" label="Event" :value="$model->event_name"/>
            <x-dashing::display-field type="text" name="icon" id="icon" label="Icon" :value="$model->icon"/>
            <x-dashing::display-field type="text" name="link" id="link" label="link" :value="$model->link"/>
            <x-dashing::display-field type="text" name="timeout" id="timeout" label="Time Out (ms)" :value="$model->timeout"/>
            <x-dashing::display-field type="text" name="scheduled_at" id="scheduled_at" label="Scheduled At" :value="$model->scheduled_at"/>
            <x-dashing::display-field type="text" name="status" id="status" label="Status" :value="$model->status_name"/>
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
