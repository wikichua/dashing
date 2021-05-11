<x-dashing::filter-card>
    <x-slot name="title">
    Advanced Filter
    </x-slot>
    <x-dashing::search-date-field type="text" name="created_at" id="created_at" label="Created At" />
    <x-dashing::search-input-field type="text" name="name" id="name" label="Name" />
    <x-dashing::search-select-field name="admin" id="admin" label="Admin" :options="[false => 'No', true => 'Yes']" multiple class="select-multiple"/>
</x-dashing::filter-card>
