<x-dashing::app-layout>
    <x-slot name="header">
        Permission Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('permission.update',[$model->id]) }}">
                <x-dashing::input-field type="text" name="group" id="group" label="Group" :value="$model->group ?? ''"/>
                {{-- <x-dashing::input-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/> --}}
                <x-dashing::multi-rows-input-field type="input" label="Permissions" :options="$permissions ?? ['']" name="name" rows="1" />
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
