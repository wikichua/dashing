<x-dashing::filter-card>
    <x-slot name="title">
    Advanced Filter
    </x-slot>
    <x-dashing::search-date-field type="text" name="created_at" id="created_at" label="Created At" />
    <x-dashing::search-input-field type="text" name="name" id="name" label="Name" />
    <x-dashing::search-input-field type="text" name="group_slug" id="group_slug" label="Group Slug" />
    <x-dashing::search-input-field type="text" name="route_slug" id="route_slug" label="Route Slug" />
</x-dashing::filter-card>

