<x-dashing::app-layout>
    <x-slot name="header">
        Cronjob Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::display-field name="name" id="name" label="Name" :value="$model->name" type="text"/>
            <x-dashing::display-field name="command" id="command" label="Command" :value="$model->command ?? ''" type="text"/>
            <x-dashing::display-field name="timezone" id="timezone" label="Timezone" :value="$model->timezone ?? ''" type="text"/>
            <x-dashing::display-field name="frequency" id="frequency" label="Frequency" :value="$model->frequency ?? ''" type="text"/>
            <x-dashing::display-field name="status" id="status" label="Status" :value="$model->status_name" type="text"/>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''" >
        <x-slot name="append">
            <x-dashing::display-field type="json" name="output" id="output" label="Output" :value="$model->output ?? []"/>
        </x-slot>
    </x-dashing::content-others-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
