<x-dashing::app-layout>
    <x-slot name="header">
      Log Viewer
    </x-slot>
    <x-slot name="breadcrumb">
        Log Viewer
    </x-slot>
    <x-dashing::content-card class="col-max">
<div class="card shadow mt-5 mb-4 p-2">
  <div class="row">
    <div class="col sidebar mb-3 bg-white">
      <div class="list-group div-scroll">
        @foreach($folders as $folder)
        <div class="list-group-item">
          <a href="?f={{ \Crypt::encrypt($folder) }}">
            <span class="fa fa-folder"></span> {{$folder}}
          </a>
          @if ($current_folder == $folder)
          <div class="list-group folder">
            @foreach($folder_files as $file)
            <a href="?l={{ \Crypt::encrypt($file) }}&f={{ \Crypt::encrypt($folder) }}"
            class="list-group-item @if ($current_file == $file) llv-active @endif">
            {{$file}}
          </a>
          @endforeach
        </div>
        @endif
      </div>
      @endforeach
      @foreach($files as $file)
      <a href="?l={{ \Crypt::encrypt($file) }}" class="list-group-item @if ($current_file == $file) llv-active @endif">
      {{$file}}
    </a>
    @endforeach
  </div>
</div>
<div class="col-10 table-container">
  @if ($logs === null)
  <div>
    Log file >50M, please download it.
  </div>
  @else
  <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
    <thead>
      <tr>
        @if ($standardFormat)
        <th>Level</th>
        <th>Context</th>
        <th>Date</th>
        @else
        <th>Line number</th>
        @endif
        <th>Content</th>
      </tr>
    </thead>
    <tbody>

      @foreach($logs as $key => $log)
      <tr data-display="stack{{{$key}}}">
        @if ($standardFormat)
        <td class="nowrap text-{{{$log['level_class']}}}">
          <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
        </td>
        <td class="text">{{$log['context']}}</td>
        @endif
        <td class="date">{{{$log['date']}}}</td>
        <td class="text">
          @if ($log['stack'])
          <button type="button"
          class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
          data-display="stack{{{$key}}}">
          <span class="fa fa-search"></span>
        </button>
        @endif
        {{{$log['text']}}}
        @if (isset($log['in_file']))
        <br/>{{{$log['in_file']}}}
        @endif
        @if ($log['stack'])
        <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
      </div>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
</table>
@endif
<div class="p-3">
  @if($current_file)
  <a href="?dl={{ \Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Crypt::encrypt($current_folder) : '' }}">
    <span class="fa fa-download"></span> Download file
  </a>
  @can('delete-log-viewer')
  -
  <a id="clean-log" href="?clean={{ \Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Crypt::encrypt($current_folder) : '' }}">
    <span class="fa fa-sync"></span> Clean file
  </a>
  -
  <a id="delete-log" href="?del={{ \Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Crypt::encrypt($current_folder) : '' }}">
    <span class="fa fa-trash"></span> Delete file
  </a>
  @if(count($files) > 1)
  -
  <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Crypt::encrypt($current_folder) : '' }}">
    <span class="fa fa-trash-alt"></span> Delete all files
  </a>
  @endif
  @endcan
  @endif
</div>
</div>
</div>
</div>
    </x-dashing::content-card>
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <style>
    #table-log {
        font-size: 0.85rem;
    }

    .sidebar {
        font-size: 0.85rem;
        line-height: 1;
    }

    .btn {
        font-size: 0.7rem;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }

    .list-group-item {
      word-break: break-word;
    }

    .folder {
      padding-top: 15px;
    }

    .div-scroll {
      height: 80vh;
      overflow: hidden auto;
    }
    .nowrap {
      white-space: nowrap;
    }
  </style>
@endpush
@push('scripts')
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [$('#table-log').data('orderingIndex'), 'desc'],
      "stateSave": true,
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });
    $('#delete-log, #clean-log, #delete-all-log').click(function () {
      return confirm('Are you sure?');
    });
  });
</script>
@endpush
</x-dashing::app-layout>
