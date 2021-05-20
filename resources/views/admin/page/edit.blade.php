<x-dashing::app-layout>
    <x-slot name="header">
        Page Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <x-dashing::form ajax="true" method="PATCH" action="{{ route('page.update',[$model->id]) }}">
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand"  :options="app(config('dashing.Models.Brand'))->query()->pluck('name','id')->toArray()" :selected="$model->brand_id ?? []"/>
                @include('dashing::admin.page.templateSelect')
                <x-dashing::input-field type="text" name="blade_file" id="blade_file" label="Blade File" :value="$model->blade_file ?? 'page'"/>
                <x-dashing::select-field name="locale" id="locale" label="Locale" :options="settings('locales')" :selected="$model->locale ?? []"/>
                <x-dashing::input-field type="text" name="name" id="name" label="Name" :value="$model->name ?? ''"/>
                <x-dashing::input-field type="text" name="slug" id="slug" label="Slug" :value="$model->slug ?? ''"/>
                <x-dashing::multi-rows-input-field type="textarea" label="Styles" :options="$model->styles ?? ['']" name="styles" rows="1" />
                <x-dashing::editor-field name="blade" id="blade" label="Content" :value="$model->blade ?? ''" :codeview='false'/>
                <x-dashing::multi-rows-input-field type="textarea" label="Scripts" :options="$model->scripts ?? ['']" name="scripts" rows="1" />
                <x-dashing::date-field name="published_at" id="published_at" label="Published Date" :value="$model->published_at ?? ''"/>
                <x-dashing::date-field name="expired_at" id="expired_at" label="Expired Date" :value="$model->expired_at ?? ''"/>
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('page_status')" :selected="$model->status ?? []"/>
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

