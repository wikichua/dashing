<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
        <div class="position-relative">
            <i class="align-middle" data-feather="bell"></i>
            <span class="indicator">{{ $unread_count }}</span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
        <div class="dropdown-menu-header">
            {{ $unread_count }} New Notifications
        </div>
        <div class="list-group">
            @forelse ($alerts as $alert)
            <a href="{{ $alert->link ?? '#' }}" class="list-group-item" data-id="{{ $alert->id }}">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <i class="{{ $alert->icon ?? 'fas fa-bell' }} text-white"></i>
                    </div>
                    <div class="col-10">
                        {{-- <div class="text-dark">update-completed</div> --}}
                        <div class="text-dark small mt-1">{!! $alert->message !!}</div>
                        <div class="text-muted small mt-1">{{ \Carbon\Carbon::parse(strtotime($alert->created_at))->diffForHumans() }} ({{ \Carbon\Carbon::parse($alert->created_at)->toFormattedDateString() }})</div>
                    </div>
                </div>
            </a>
            @empty
                {{-- empty expr --}}
            @endforelse
        </div>
        <div class="dropdown-menu-footer">
            <a href="#" class="text-muted">Show all notifications</a>
        </div>
    </div>
</li>
@push('scripts')
<script>
$(function() {
    $(document).on('click', '.alert-link', function(event) {
        event.preventDefault();
        axios.put(route('alert.set.read',[$(this).data('id')]))
        .then((response) => {
            if(response.data != '')
            {
                window.location = response.data;
            }
        }).catch((error) => {
          console.error(error);
        }).finally(() => {
          // TODO
        });
    });
});
</script>
@endpush
