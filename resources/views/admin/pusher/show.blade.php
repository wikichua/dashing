<x-dashing::app-layout>
    <x-slot name="header">
        Nav Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
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
