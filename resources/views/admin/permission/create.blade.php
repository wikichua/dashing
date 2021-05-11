<x-dashing::app-layout>
    <x-slot name="header">
        Permission Management - Create
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::form ajax="true" method="POST" action="{{ route('permission.store') }}">
                <x-dashing::input-field type="text" name="group" id="group" label="Group" value=""/>
                <x-dashing::input-field type="text" name="name" id="name" label="Name" value=""/>
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

