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
            <x-dashing::display-field type="text" name="slug" id="slug" label="Slug" :value="$model->slug"/>
            <x-dashing::display-field type="text" name="brand_id" id="brand_id" label="Brand" :value="$model->brand_id"/>
            <x-dashing::display-field type="text" name="image_url" id="image_url" label="Image" :value="$model->image_url"/>
            <x-dashing::display-field type="text" name="caption" id="caption" label="Caption" :value="$model->caption"/>
            <x-dashing::display-field type="text" name="seq" id="seq" label="Ordering" :value="$model->seq"/>
            <x-dashing::display-field type="text" name="tags" id="tags" label="Tags" :value="$model->tags"/>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''">
        <x-slot name="prepend">
            <x-dashing::display-field type="text" name="published_at" id="published_at" label="Published Date" :value="$model->published_at"/>
            <x-dashing::display-field type="text" name="expired_at" id="expired_at" label="Expired Date" :value="$model->expired_at"/>
            <x-dashing::display-field type="text" name="status" id="status" label="Status" :value="$model->status"/>
        </x-slot>
    </x-dashing::content-others-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
