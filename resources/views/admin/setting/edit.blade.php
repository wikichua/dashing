<x-dashing::app-layout>
    <x-slot name="header">
        Setting Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('setting.update',[$model->id]) }}">
                <x-dashing::input-field type="text" name="key" id="key" label="Key" value=""/>
                <x-dashing::checkbox-field name="protected" id="protected" label="Apply Encryption" :value="1" :checked="$model->protected ?? 0">Yes</x-dashing::checkbox-field>
                @include('dashing::admin.setting.valueInput')
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



