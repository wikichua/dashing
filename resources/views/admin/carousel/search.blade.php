<x-dashing::filter-card>
    <x-slot name="title">
    Advanced Filter
    </x-slot>
    <x-dashing::search-input-field type="text" name="slug" id="slug" label="Slug" />
    <x-dashing::search-select-field name="tags" id="tags" label="Tags" :options="settings('carousel_tags')" multiple="multiple" />
    <x-dashing::search-date-field type="text" name="published_at" id="published_at" label="Published At" />
    <x-dashing::search-date-field type="text" name="expired_at" id="expired_at" label="Expired At" />
    <x-dashing::search-select-field name="status" id="status" label="Status" :options="settings('carousel_status')" multiple="multiple" />
</x-dashing::filter-card>

