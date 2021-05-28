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
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="brand_id" id="brand_id" label="Brand" :value="$model->brand->name ?? ''"/>
            <x-dashing::display-field type="text" name="mode" id="mode" label="Mode" :value="$model->mode ?? ''"/>
            <x-dashing::display-field type="text" name="model_id" id="model_id" label="Model ID" :value="$model->model_id ?? ''"/>
            <x-dashing::display-field type="text" name="model_class" id="model_class" label="Model" :value="$model->model_class ?? ''"/>
            <x-dashing::display-field type="json" name="data" id="data" label="Data" :value="$model->data ?? ''"/>
            <x-dashing::display-field type="json" name="changes" id="changes" label="Changes" :value="$model->changes ?? ''"/>
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
