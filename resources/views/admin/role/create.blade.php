<x-dashing::app-layout>
    <x-slot name="header">
        Role Management - Create
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="POST" action="{{ route('role.store') }}">
                <x-dashing::input-field type="text" name="name" id="name" label="Name" value=""/>
                <x-dashing::select-field name="admin" id="admin" label="Is Admin" :options="[false=>'No',true=>'Yes']" :selected="[]"/>
                <div class="mb-3 row"><label class="col-form-label col-sm-2 text-sm-end">Permissions</label></div>
                @foreach ($group_permissions as $label => $permissions)
                <x-dashing::checkboxes-field name="permissions" id="permissions" :label="$label" :options="$permissions" :inline="true"/>
                @endforeach
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

