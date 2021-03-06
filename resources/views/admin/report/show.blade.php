<x-dashing::app-layout>
    <x-slot name="header">
        Report Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-8">
        <x-slot name="title">Details</x-slot>
        <div class="px-5">
            <nav>
                <div class="nav nav-tabs nav-fills" id="nav-tab" role="tablist">
                    @foreach ($models as $model)
                    <a class="nav-link {{ $loop->iteration == 1? 'active':'' }}" id="nav-sql-{{ $loop->iteration }}-tab" data-bs-toggle="tab" href="#nav-sql-{{ $loop->iteration }}" role="tab" aria-controls="nav-sql-{{ $loop->iteration }}" aria-selected="false">SQL {{ $loop->iteration }}</a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content">
                @foreach ($models as $index => $model)
                <div class="tab-pane fade {{ $loop->iteration == 1? 'show active':'' }}" id="nav-sql-{{ $loop->iteration }}" role="tabpanel" aria-labelledby="nav-sql-{{ $loop->iteration }}-tab">
                    <div class="text-secondary p-2 text-center">
                        <i class="fas fa-quote-left"></i>
                        <span class="mx-3">{{ $report->queries[$index] }}</span>
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <x-dashing::report-table :data="$model"/>
                </div>
                @endforeach
            </div>
        </div>
    </x-dashing::content-card>
    <x-dashing::content-others-card :model="$model ?? ''" />
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>

