<x-dashing::app-layout>
    <x-slot name="header">
        Permission Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id"/>
            <x-dashing::display-field type="text" name="name" id="name" label="Name" :value="$model->name"/>
            <x-dashing::display-field type="text" name="group" id="group" label="Group" :value="$model->group"/>
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
