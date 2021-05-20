<x-dashing::app-layout>
    <x-slot name="header">
        Failed Job Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="queue" id="queue" label="Queue" :value="$model->queue ?? ''"/>
            <x-dashing::display-field type="code" name="payload" id="payload" label="Payload" :value="$model->payload ?? ''"/>
            <x-dashing::display-field type="code" name="exception" id="exception" label="Exception" :value="$model->exception ?? ''"/>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''">
        <x-slot name="append">
            <x-dashing::display-field type="text" name="failed_at" id="failed_at" label="Failed At" :value="$model->failed_at ?? ''"/>
        </x-slot>
    </x-dashing::content-others-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
