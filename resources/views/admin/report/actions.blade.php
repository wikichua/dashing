<div class="text-right text-nowrap">
    @if (strtolower($model->cache_status) == 'ready')
    <a href="{{ route('report.show', $model->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fas fa-lg fa-eye"></i></a>
    @can('export-reports')
    <form method="POST" action="{{ route('report.export', $model->id) }}" class="d-inline-block">
        @csrf
        <button type="submit" class="btn btn-link text-secondary p-1" title="Export">
        <i class="fas fa-lg fa-file-export"></i>
        </button>
    </form>
    @endcan
    @endif
    @can('update-reports')
    <a href="{{ route('report.edit', $model->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fas fa-lg fa-edit"></i></a>
    @endcan
    @can('delete-reports')
    <x-dashing::form ajax="true" method="DELETE" action="{{ route('report.destroy', $model->id) }}" class="d-inline-block" confirm="You won't be able to revert this!">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Delete">
        <i class="fas fa-lg fa-trash-alt"></i>
        </button>
    </x-dashing::form>
    @endcan
</div>
