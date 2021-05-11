@can('rename-files')
    <button type="button" data-href="{{ route('file.rename', $filepath) }}"  data-filename="{{ $filename }}" class="btn btn-link text-secondary p-1 renameBtn" title="Rename"><i class="fas fa-lg fa-file-signature"></i></button>
@endcan
@can('copy-files')
    <button type="button" data-href="{{ route('file.duplicate', $filepath) }}"  data-filename="{{ $filename }}" class="btn btn-link text-secondary p-1 duplicateBtn" title="Duplicate"><i class="fas fa-lg fa-copy"></i></button>
@endcan
@can('delete-files')
<x-dashing::form ajax="true" method="DELETE" action="{{ route('file.destroy', $filepath) }}" class="d-inline-block" confirm="You won't be able to revert this!">
    <button type="submit" class="btn btn-link text-secondary p-1" title="Delete">
        <i class="fas fa-lg fa-trash-alt"></i>
    </button>
</x-dashing::form>
@endcan
