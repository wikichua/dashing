<x-dashing::app-layout>
    <x-slot name="header">
        User Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id ?? ''"/>
            <x-dashing::display-field type="text" name="brand" id="brand" label="Brand" :value="$model->brand->name ?? 'System'"/>
            <x-dashing::display-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
            <x-dashing::display-field type="text" name="email" id="email" label="Email" :value="$model->email ?? ''"/>
            <x-dashing::display-field type="text" name="timezone" id="timezone" label="Timezone" :value="$model->timezone ?? ''"/>
            <x-dashing::display-field type="text" name="type" id="type" label="Type" :value="$model->type ?? ''"/>
            <x-dashing::display-field type="text" name="roles" id="roles" label="Roles" :value="$model->roles_string ?? ''"/>
            <x-dashing::display-field type="code" name="last_activity" id="last_activity" label="Last Activity" :value="$model->last_activity ?? []"/>
            <x-dashing::display-field type="text" name="created_at" id="created_at" label="Created At" :value="$model->created_at ?? ''"/>
            <x-dashing::display-field type="text" name="created_by" id="created_by" label="Created By" :value="$model->creator->name ?? ''"/>
            <x-dashing::display-field type="text" name="updated_at" id="updated_at" label="Updated At" :value="$model->updated_at ?? ''"/>
            <x-dashing::display-field type="text" name="updated_by" id="updated_by" label="Updated By" :value="$model->modifier->name ?? ''"/>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
