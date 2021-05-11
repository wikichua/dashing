<x-dashing::app-layout>
    <x-slot name="header">
        Brand Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('brand.update',[$model->id]) }}">
                <x-dashing::input-field type="text" name="name" id="name" label="Brand Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="text" name="domain" id="domain" label="Domain" :value="$model->domain ?? ''"/>
                <x-dashing::date-field name="published_at" id="published_at" label="Published Date" :value="$model->published_at ?? ''"/>
                <x-dashing::date-field name="expired_at" id="expired_at" label="Expired Date" :value="$model->expired_at ?? ''"/>
                <x-dashing::select-field name="status" id="status" label="Status"  :options="settings('brand_status')" :selected="$model->status ?? []"/>
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
