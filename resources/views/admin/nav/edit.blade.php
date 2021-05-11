<x-dashing::app-layout>
    <x-slot name="header">
        Nav Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('nav.update',[$model->id]) }}">
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand" :options="app(config('dashing.Models.Brand'))->query()->pluck('name','id')->toArray()" :selected="$model->brand_id ?? []"/>
                <x-dashing::select-field name="locale" id="locale" label="Locale" :options="settings('locales')" :selected="$model->locale ?? []"/>
                <x-dashing::input-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="text" name="group_slug" id="group_slug" label="Group Slug" :value="$model->group_slug ?? ''"/>
                <x-dashing::input-field type="number" name="seq" id="seq" label="Ordering" :value="$model->seq ?? '1'"/>
                <x-dashing::input-field type="text" name="icon" id="icon" label="Icon" :value="$model->icon ?? ''"/>
                @include('dashing::admin.nav.routeSlugSelect')
                <x-dashing::multi-rows-input-field type="text" label="Route Params" :options="$model->route_params ?? ['']" name="route_params" rows="1" />
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('nav_status')" :selected="$model->status ?? []"/>
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

