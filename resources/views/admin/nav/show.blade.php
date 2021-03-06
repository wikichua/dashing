<x-dashing::app-layout>
    <x-slot name="header">
        Nav Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            @php
            if (isset($model->brand->name)) {
                $link = '<a href="'.route_slug(strtolower($model->brand->name).'.page',$model->route_slug,$model->route_params, $model->locale).'" target="_blank">'.$model->name.'</a>';
            }
            @endphp
            <x-dashing::display-field type="text" name="sample" id="sample" label="Display" :value="$link"/>
            <x-dashing::display-field type="text" name="id" id="id" label="ID" :value="$model->id"/>
            <x-dashing::display-field type="text" name="seq" id="seq" label="Ordering" :value="$model->seq"/>
            <x-dashing::display-field type="text" name="name" id="name" label="Name" :value="$model->name"/>
            <x-dashing::display-field type="text" name="brand_id" id="brand_id" label="Brand" :value="$model->brand->name"/>
            <x-dashing::display-field type="text" name="locale" id="locale" label="Locale" :value="$model->locale"/>
            <x-dashing::display-field type="text" name="group_slug" id="group_slug" label="Group Slug" :value="$model->group_slug"/>
            <x-dashing::display-field type="text" name="icon" id="icon" label="Icon" :value="$model->icon"/>
            <x-dashing::display-field type="text" name="route_slug" id="route_slug" label="Route Slug" :value="$model->route_slug"/>
            <x-dashing::display-field type="text" name="route_params" id="route_params" label="Route Params" :value="$model->route_params" :type="is_array($model->route_params)? 'list':''"/>
            <x-dashing::display-field type="text" name="status" id="status" label="Status" :value="$model->status_name"/>
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
