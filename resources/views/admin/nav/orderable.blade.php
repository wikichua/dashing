<x-dashing::app-layout>
    <x-slot name="header">
        Nav Management - Ordering
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('home') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div>
            <x-dashing::orderable-datatable :data="$html" :url="$getUrl" />
        </div>
    </x-dashing::content-card>
    @include('dashing::admin.nav.search')
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
