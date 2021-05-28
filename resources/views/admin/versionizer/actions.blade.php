<div class="text-right text-nowrap">
    <a href="{{ route('versionizer.show', $model->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fas fa-lg fa-eye"></i></a>
    @can('revert-versionizers')
    @if (trim($model->reverted_at) == '')
    <x-dashing::form ajax="true" method="PATCH" action="{{ route('versionizer.revert', $model->id) }}" class="d-inline-block" confirm="You won't be able to revert this!">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Revert this version">
            <i class="fas fa-lg fa-recycle"></i>
        </button>
    </x-dashing::form>
    @endif
    @endcan
    @can('delete-versionizers')
    <x-dashing::form ajax="true" method="DELETE" action="{{ route('versionizer.destroy', $model->id) }}" class="d-inline-block" confirm="You won't be able to revert this!">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Delete">
            <i class="fas fa-lg fa-trash-alt"></i>
        </button>
    </x-dashing::form>
    @endcan
</div>
