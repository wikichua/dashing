<x-dashing::app-layout>
    <x-slot name="header">
        Edit My Profile / Change Password
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-4">
        <x-slot name="title">Update Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('profile.update') }}">
                <x-dashing::input-field type="text" name="name" id="name" label="Full Name" :value="$model->name"/>
                <x-dashing::input-field type="email" name="email" id="email" label="Email" :value="$model->email"/>
                <x-dashing::select-field name="timezone" id="timezone" label="Timezone" :options="Help::timezones()" :selected="$model->timezone"/>
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-card class="col-4">
        <x-slot name="title">Update Password</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('profile.updatePassword') }}">
                <x-dashing::input-field type="password" name="current_password" id="current_password" label="Current Password" />
                <x-dashing::input-field type="password" name="password" id="password" label="Password" />
                <x-dashing::input-field type="password" name="password_confirmation" id="password_confirmation" label="Confirm Password" />
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''">
        <x-slot name="append">
            <x-dashing::display-field type="code" name="last_activity" id="last_activity" label="Last Activity" :value="$model->last_activity ?? []"/>
        </x-slot>
    </x-dashing::content-others-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>


