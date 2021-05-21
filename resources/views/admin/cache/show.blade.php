<x-dashing::app-layout>
    <x-slot name="header">
        Versionizer Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field type="text" name="key" id="key" label="Key" :value="$model->key ?? ''"/>
            <x-dashing::display-field type="json" name="value" id="value" label="Value" :value="$model->value ?? ''"/>
            <x-dashing::display-field type="text" name="seconds" id="seconds" label="Seconds" :value="$model->seconds ?? ''"/>
            <x-dashing::display-field type="json" name="tags" id="tags" label="Tags" :value="$model->tags ?? ''"/>
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
