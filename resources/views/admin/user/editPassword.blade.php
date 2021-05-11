<x-dashing::app-layout>
    <x-slot name="header">
        User Management - Edit Password
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('user.updatePassword',[$id]) }}">
                <x-dashing::input-field type="password" name="password" id="password" label="Password"  />
                <x-dashing::input-field type="password" name="password_confirmation" id="password_confirmation" label="Confirm Password"  />
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


