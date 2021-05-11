<li class="list-group-item">{!! $data['title'] !!}
    <div class="float-end">
        <button data-href="{{ $data['path'] }}" class="btn btn-sm btn-outline-dark rounded-3 goToDirectory" data-title="{{ $data['label'] }}" title="Open Folder" id="{{ $data['dom_id'] ?? '' }}">
        <i class="fas fa-folder-open"></i>
        </button>
        @can('rename-folders')
        <button data-href="{{ route('folder.change', $data['path']) }}" data-dirname="{{ $data['dirname'] }}" class="btn btn-sm btn-outline-dark rounded-3 renameFolderBtn" data-title="{{ $data['label'] }}" title="Rename Folder">
        <i class="fas fa-edit"></i>
        </button>
        @endcan
        @can('copy-folders')
        <button data-href="{{ route('folder.clone', $data['path']) }}" data-dirname="{{ $data['dirname'] }}" class="btn btn-sm btn-outline-dark rounded-3 copyFolderBtn" data-title="{{ $data['label'] }}" title="Copy Folder">
        <i class="fas fa-clone"></i>
        </button>
        @endcan
        @can('delete-folders')
        <button data-href="{{ route('folder.remove', $data['path']) }}" data-dirname="{{ $data['dirname'] }}" class="btn btn-sm btn-outline-dark rounded-3 deleteFolderBtn" data-title="{{ $data['label'] }}" title="Delete Folder">
        <i class="fas fa-trash"></i>
        </button>
        @endcan
    </div>
</li>
