<x-dashing::app-layout>
    <x-slot name="header">
        Carousel Management - Create
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
             <x-dashing::form ajax="true" method="POST" action="{{ route('carousel.store') }}">
                <x-dashing::input-field type="text" name="slug" id="slug" label="Slug" :value="$model->slug ?? ''"/>
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand" :options="app(config('dashing.Models.Brand'))->query()->pluck('name','id')->toArray()" :selected="$model->brand_id ?? []"/>
                <x-dashing::image-field type="image" name="image_url" id="image_url" label="Image" :value="$model->image_url ?? ''" />
                <x-dashing::textarea-field name="caption" id="caption" label="Caption" :value="$model->caption ?? ''"/>
                <x-dashing::input-field type="number" name="seq" id="seq" label="Ordering" min="1" max="100" :value="$model->seq ?? ''"/>
                <x-dashing::select-field name="tags" id="tags" label="Tags" multiple :options="settings('carousel_tags')" :selected="$model->tags ?? []"/>
                <x-dashing::date-field name="published_at" id="published_at" label="Published Date" :value="$model->published_at ?? ''"/>
                <x-dashing::date-field name="expired_at" id="expired_at" label="Expired Date" :value="$model->expired_at ?? ''"/>
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('carousel_status')" :selected="$model->status ?? []"/>
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

