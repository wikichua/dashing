<x-dashing::app-layout>
    <x-slot name="header">
        Cronjob Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::display-field name="name" id="name" label="Name" :value="$model->name" type="text"/>
            <x-dashing::display-field name="command" id="command" label="Command" :value="$model->command ?? ''" type="text"/>
            <x-dashing::display-field name="timezone" id="timezone" label="Timezone" :value="$model->timezone ?? ''" type="text"/>
            <x-dashing::display-field name="frequency" id="frequency" label="Frequency" :value="$model->frequency ?? ''" type="text"/>
            <x-dashing::display-field name="status" id="status" label="Status" :value="$model->status_name" type="text"/>
            <x-dashing::display-field type="text" name="created_at" id="created_at" label="Created At" :value="$model->created_at"/>
            <x-dashing::display-field type="text" name="created_by" id="created_by" label="Created By" :value="$model->creator->name"/>
            <x-dashing::display-field type="text" name="updated_at" id="updated_at" label="Updated At" :value="$model->updated_at"/>
            <x-dashing::display-field type="text" name="updated_by" id="updated_by" label="Updated By" :value="$model->modifier->name"/>
            <x-dashing::display-field type="json" name="output" id="output" label="Output" :value="$model->output ?? []"/>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
