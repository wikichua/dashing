<x-dashing::app-layout>
    <x-slot name="header">
        Cronjob Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('cronjob.update',[$model->id]) }}">
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand" :options="selectBrandIDs()" :selected="$model->brand_id ?? []"/>
                <x-dashing::input-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="text" name="command" id="command" label="Command" :value="$model->command ?? ''"/>
                <x-dashing::select-field name="timezone" id="timezone" label="Timezone" :options="timezones()" :selected="$model->timezone ?? []"/>
                <x-dashing::select-field name="frequency" id="frequency" label="Frequency" :options="cronjob_frequencies()" :selected="$model->frequency ?? []"/>
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('cronjob_status')" :selected="$model->status ?? []"/>
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
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

