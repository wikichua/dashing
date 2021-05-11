<x-dashing::app-layout>
    <x-slot name="header">
        Report Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('report.update',[$model->id]) }}">
                <x-dashing::input-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="number" name="cache_ttl" id="cache_ttl" label="TTL (Seconds)" :value="$model->cache_ttl ?? '300'"/>
                <x-dashing::multi-rows-input-field type="textarea" label="SQL queries" :options="$model->queries ?? ['select * from users;']" name="queries" rows="1" />
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('report_status')" :selected="$model->status ?? []"/>
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>



