<x-dashing::filter-card>
    <x-slot name="title">
    Advanced Filter
    </x-slot>
    <x-dashing::search-input-field type="text" name="name" id="name" label="Name" />
    <x-dashing::search-input-field type="text" name="domain" id="domain" label="Domain" />
    <x-dashing::search-date-field type="text" name="published_at" id="published_at" label="Published At" />
    <x-dashing::search-date-field type="text" name="expired_at" id="expired_at" label="Expired At" />
    <x-dashing::search-select-field name="status" id="status" label="Status" :options="settings('brand_status')" multiple="multiple" />
</x-dashing::filter-card>
