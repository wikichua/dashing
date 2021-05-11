<x-dashing::app-layout>
    <x-slot name="header">
        Cronjob Management - List
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('home') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div>
            <x-dashing::datatable :data="$html" :url="$getUrl">
                <x-slot name="toolbar">
                    @can('create-cronjobs')
                    <a class="btn btn-outline-secondary" href="{{ route('cronjob.create') }}">
                        <i class="fas fa-folder-plus mr-2"></i>New
                    </a>
                    @endcan
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModalCenter">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </x-slot>
            </x-dashing::datatable>
        </div>
    </x-dashing::content-card>
    @include('dashing::admin.cronjob.search')
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>
