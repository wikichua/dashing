@props(['id'=>'filterModalCenter','titleId' => 'filterModalCenterTitle','btnId' => 'filterBtn','btnIcon' => 'fas fa-search', 'btnLabel' => 'Filter'])
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $titleId }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ $titleId }}">{{ $title }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="{{ $btnId }}">
                    <i class="{{ $btnIcon }} mr-2"></i>{{ $btnLabel }}
                </button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>

</script>
@endpush
