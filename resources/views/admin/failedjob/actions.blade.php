<div class="text-right text-nowrap">
    <a href="{{ route('failedjob.show', $model->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fas fa-lg fa-eye"></i></a>
    @can('retry-failed-jobs')
    <x-dashing::form ajax="true" method="POST" action="{{ route('failedjob.retry', $model->id) }}" class="d-inline-block"confirm="Are you sure you want to retry this queue?">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Retry">
            <i class="fas fa-lg fa-redo-alt"></i>
        </button>
    </x-dashing::form>
    @endcan
</div>
