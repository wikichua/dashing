<x-dashing::filter-card>
    <x-slot name="title">
    Advanced Filter
    </x-slot>
    <x-dashing::search-input-field type="text" name="key" id="key" label="Key" />
    <x-dashing::search-select-field type="text" name="tags" id="tags" label="Tags" :options="[]" multiple/>
</x-dashing::filter-card>
