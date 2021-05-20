<x-dashing::app-layout>
    <x-slot name="header">
        User Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="brand" id="brand" label="Brand" :value="$model->brand->name ?? 'System'"/>
            <x-dashing::display-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
            <x-dashing::display-field type="text" name="email" id="email" label="Email" :value="$model->email ?? ''"/>
            <x-dashing::display-field type="text" name="timezone" id="timezone" label="Timezone" :value="$model->timezone ?? ''"/>
            <x-dashing::display-field type="text" name="type" id="type" label="Type" :value="$model->type ?? ''"/>
            <x-dashing::display-field type="text" name="roles" id="roles" label="Roles" :value="$model->roles_string ?? ''"/>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''">
        <x-slot name="append">
            <x-dashing::display-field type="code" name="last_activity" id="last_activity" label="Last Activity" :value="$model->last_activity ?? []"/>
        </x-slot>
    </x-dashing::content-others-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
