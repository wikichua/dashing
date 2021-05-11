<x-dashing::app-layout>
    <x-slot name="header">
        Failed Job Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="queue" id="queue" label="Queue" :value="$model->queue ?? ''"/>
            <x-dashing::display-field type="code" name="payload" id="payload" label="Payload" :value="$model->payload ?? ''"/>
            <x-dashing::display-field type="code" name="exception" id="exception" label="Exception" :value="$model->exception ?? ''"/>
            <x-dashing::display-field type="text" name="failed_at" id="failed_at" label="Failed At" :value="$model->failed_at ?? ''"/>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
