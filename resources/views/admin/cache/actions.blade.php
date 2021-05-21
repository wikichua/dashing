<div class="text-right text-nowrap">
    <a href="{{ route('cache.show', $model->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fas fa-lg fa-eye"></i></a>
    @can('delete-caches')
    <x-dashing::form ajax="true" method="DELETE" action="{{ route('cache.destroy', $model->id) }}" class="d-inline-block" confirm="You won't be able to revert this!">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Delete">
            <i class="fas fa-lg fa-trash-alt"></i>
        </button>
    </x-dashing::form>
    @endcan
</div>
