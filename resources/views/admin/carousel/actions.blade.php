<div class="text-right text-nowrap">
    <a href="{{ route('carousel.show', $model->id) }}" class="btn btn-link text-secondary p-1" title="Read"><i class="fas fa-lg fa-eye"></i></a>
    <a href="{{ route('carousel.orderable',[$model->slug, $model->brand_id]) }}" class="btn btn-link text-secondary p-1" title="Reorder List"><i class="fas fa-sort-numeric-up"></i></a>
    @can('update-carousels')
        <a href="{{ route('carousel.edit', $model->id) }}" class="btn btn-link text-secondary p-1" title="Update"><i class="fas fa-lg fa-edit"></i></a>
    @endcan
    @can('delete-carousels')
    <x-dashing::form ajax="true" method="DELETE" action="{{ route('carousel.destroy', $model->id) }}" class="d-inline-block" confirm="You won't be able to revert this!">
        <button type="submit" class="btn btn-link text-secondary p-1" title="Delete">
            <i class="fas fa-lg fa-trash-alt"></i>
        </button>
    </x-dashing::form>
    @endcan
</div>
