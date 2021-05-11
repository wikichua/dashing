<x-dashing::app-layout>
    <x-slot name="header">
        File Management
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('home') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5 row">
            <div class="col-3">
                <div class="list-group">
                    <button data-href="{{ $path ?? '' }}" class="goToDirectory invisible" id="goToPath" data-title="Top"></button>
                    <button data-href="" class="list-group-item list-group-item-action goToDirectory" id="goToTopDirectory" data-title="Top">Top</button>
                    <div id="directoriesContent"></div>
                </div>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <strong>Files in <span class="onDirectory"></span> directory.</strong>
                    <x-dashing::datatable :data="$html" :url="$getUrl" :options="[]">
                        <x-slot name="toolbar">
                            @can('create-folders')
                            <button type="button" class="btn btn-outline-secondary" id="createFolderBtn" data-href="" data-dirname="">
                                <i class="fas fa-folder-plus mr-2"></i>Create folder at <span class="onDirectory"></span>
                            </button>
                            @endcan
                            @can('upload-files')
                            <button type="button" class="btn btn-outline-secondary" id="uploadFileBtn" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
                                <i class="fas fa-folder-plus mr-2"></i>Upload file to <span class="onDirectory"></span>
                            </button>
                            @endcan
                        </x-slot>
                    </x-dashing::datatable>
                </div>
            </div>
        </div>
    </x-dashing::content-card>

@can('upload-files')
<x-dashing::filter-card id="uploadFileModal"
    titleId="uploadFileModalLabel"
    btnId="uploadeFileBtn"
    btnIcon="fas fa-upload"
    btnLabel="Upload">
    <x-slot name="title">
    Upload File to <span class="onDirectory"></span>
    </x-slot>
    <x-dashing::form ajax="true" method="POST" action="" id="uploadFileForm" >
        <x-dashing::file-field type="image" name="files" id="files" label="File" multiple value="" />
    </x-dashing::form>
</x-dashing::filter-card>
@endcan

@push('scripts')
<script id="directoriesTemplate" type="text/x-lodash-template">
<% _.forEach(data, function(item) { %>
<%= item.view %>
<% }); %>
</script>
<script>
$(function() {
    $(document).on('click', '#uploadeFileBtn', function(event) {
        event.preventDefault();
        $('#uploadFileForm').submit();
        /* Act on the event */
    });
    $(document).on('click', '.goToDirectory', function(event) {
        event.preventDefault();
        let path = $(this).data('href');
        axios.post(route('folder.directories'),{
            path: path
        }).then((response) => {
            var templateFn = _.template($('#directoriesTemplate').html());
            var templateHTML = templateFn(response);
            $('#directoriesContent').html(templateHTML);
        }).catch((error) => {
          console.error(error);
        }).finally(() => {
            let params = {
                path: path
            };
            loadDatatable(url, params);
            let onDirectory = $(this).data('title');
            $('.onDirectory').html(onDirectory);
            $('#uploadFileForm').attr('action', route('file.upload',[path]));
            $('#createFolderBtn').data('href', route('folder.make',[path]));
        });
    });
    @if (isset($path) && $path != '')
    $('#goToPath').trigger('click');
    @else
    $('#goToTopDirectory').trigger('click');
    @endif
    $(document).on('click', '.duplicateBtn, .renameBtn', function(event) {
        event.preventDefault();
        let filename = $(this).data('filename');
        let href = $(this).data('href');
        let title = 'File duplicate as...';
        if ($(this).hasClass('renameBtn')) {
            title = 'File rename to...';
        }
        Swal.fire({
            title: title,
            input: 'text',
            inputValue: filename,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (filename) => {
                return axios.put(href, {
                  name: filename,
                }).then((response) => {
                    let resp = response.data;
                    if (_.isUndefined(resp.status) == false && resp.status == 'success') {
                        if (_.isUndefined(resp.flash) == false && _.isString(resp.flash)) {
                            cookies.set('flash-status', resp.status);
                            cookies.set('flash-message', resp.flash);
                        }
                        if (_.isUndefined(resp.relist) == false && resp.relist) {
                            flashMessage();
                            loadDatatable(currentUrl);
                        }
                    }
                }).catch((error) => {
                    let resp = error.response.data;
                    if (_.isUndefined(resp.message) == false && resp.message) {
                        Toast.fire({
                            icon: 'error',
                            title: resp.message
                        });
                    }
                }).finally(() => {
                  // TODO
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    });
    $(document).on('click', '.deleteFolderBtn, .renameFolderBtn, .copyFolderBtn, #createFolderBtn', function(event) {
        event.preventDefault();
        let dirname = $(this).data('dirname');
        let href = $(this).data('href');
        let title = 'Create New Folder as...';
        if ($(this).hasClass('renameFolderBtn')) {
            title = 'Folder rename to...';
        } else if ($(this).hasClass('copyFolderBtn')) {
            title = 'Folder duplicate to...';
        }
        if ($(this).hasClass('deleteFolderBtn')) {
            Swal.fire({
                title: 'Are you sure to delete this folder?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(href).then((response) => {
                        let resp = response.data;
                        if (_.isUndefined(resp.status) == false && resp.status == 'success') {
                            if (_.isUndefined(resp.flash) == false && _.isString(resp.flash)) {
                                cookies.set('flash-status', resp.status);
                                cookies.set('flash-message', resp.flash);
                            }
                            if (_.isUndefined(resp.relist) == false && resp.relist) {
                                flashMessage();
                                $('#currentPathId').trigger('click');
                            }
                        }
                    }).catch((error) => {
                        let resp = error.response.data;
                        if (_.isUndefined(resp.message) == false && resp.message) {
                            Toast.fire({
                                icon: 'error',
                                title: resp.message
                            });
                        }
                    }).finally(() => {
                      // TODO
                    });
                }
            })
        } else {
            Swal.fire({
                title: title,
                input: 'text',
                inputValue: dirname,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: (dirname) => {
                    return axios.put(href, {
                      name: dirname,
                    }).then((response) => {
                        let resp = response.data;
                        if (_.isUndefined(resp.status) == false && resp.status == 'success') {
                            if (_.isUndefined(resp.flash) == false && _.isString(resp.flash)) {
                                cookies.set('flash-status', resp.status);
                                cookies.set('flash-message', resp.flash);
                            }
                            if (_.isUndefined(resp.relist) == false && resp.relist) {
                                flashMessage();
                                $('#currentPathId').trigger('click');
                            }
                        }
                    }).catch((error) => {
                        let resp = error.response.data;
                        if (_.isUndefined(resp.message) == false && resp.message) {
                            Toast.fire({
                                icon: 'error',
                                title: resp.message
                            });
                        }
                    }).finally(() => {
                      // TODO
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }
    });
});
</script>
@endpush
</x-dashing::app-layout>
