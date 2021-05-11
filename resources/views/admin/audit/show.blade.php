<x-dashing::app-layout>
    <x-slot name="header">
        Audit - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="brand" id="brand" label="Brand" :value="$model->brand->name ?? ''"/>
            <x-dashing::display-field type="text" name="user" id="user" label="User" :value="$model->user->name ?? ''"/>
            <x-dashing::display-field type="text" name="model_id" id="model_id" label="Model ID" :value="$model->model_id ?? ''"/>
            <x-dashing::display-field type="text" name="model_class" id="model_class" label="Model" :value="$model->model_class ?? ''"/>
            <x-dashing::display-field type="text" name="created_at" id="created_at" label="Created At" :value="$model->created_at ?? ''"/>
            <x-dashing::display-field type="text" name="message" id="message" label="Message" :value="$model->message ?? ''"/>
            <x-dashing::display-field type="json" name="data" id="data" label="Data" :value="$model->data ?? ''"/>
            <x-dashing::display-field type="json" name="agents" id="agents" label="Agents" :value="$model->agents ?? ''"/>
            <x-dashing::display-field type="json" name="iplocation" id="iplocation" label="Ip Location" :value="$model->iplocation ?? ''"/>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>

