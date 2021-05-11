<x-dashing::app-layout>
    <x-slot name="header">
        Report Management - Show
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
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
                    <div class="text-secondary my-3">{{ $report->queries[$index] }}</div>
                    <x-dashing::report-table :data="$model"/>
                </div>
                @endforeach
            </div>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>

