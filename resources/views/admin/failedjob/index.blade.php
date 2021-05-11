<x-dashing::app-layout>
    <x-slot name="header">
        Failed Job Management - List
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('home') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div>
            <x-dashing::datatable :data="$html" :url="$getUrl">
                <x-slot name="toolbar">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModalCenter">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </x-slot>
            </x-dashing::datatable>
        </div>
    </x-dashing::content-card>
    @include('dashing::admin.failedjob.search')
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
