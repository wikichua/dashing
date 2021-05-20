<x-dashing::app-layout>
    <x-slot name="header">
        User Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Information</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('user.update',[$model->id]) }}">
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand" :options="['' => 'System'] + app(config('dashing.Models.Brand'))->query()->pluck('name','id')->toArray()" :selected="$model->brand_id ?? []"/>
                <x-dashing::input-field type="text" name="name" id="name" label="Full Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="email" name="email" id="email" label="Email" :value="$model->email ?? ''"/>
                <x-dashing::select-field name="timezone" id="timezone" label="Timezone" :options="timezones()" :selected="$model->timezone ?? []"/>
                <x-dashing::select-field name="type" id="type" label="Type" :options="settings('user_types')" :selected="$model->type ?? []"/>
                <x-dashing::checkboxes-field name="roles" id="roles" label="Roles" :options="$roles->toArray()" :isGroup="false" :checked="$model->roles()->pluck('role_id')->toArray() ?? []"/>
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


