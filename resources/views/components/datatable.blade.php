@props(['data','url','options' => [10 => 10,25 => 25,50 => 50,100 => 100,200 => 200]])
<div id="toolbar" class="d-inline-flex d-inline-block">
  <div class="input-group mb-3">
    {!! $toolbar ?? '' !!}
    @if (count($options))
    <select class="form-select pageTake" name="take" id="pageTake">
      @foreach ($options as $option)
      <option value="{{ $option }}" {{ old('take',25) == $option ? 'selected' : '' }}>
        {{ $option }}
      </option>
      @endforeach
    </select>
    @endif
  </div>
</div>
<table id="bootstrap-table"
  class="bootstrap-table table table-hover table-striped table-bordered"
  data-toolbar="#toolbar"
  data-show-columns="true"
  data-show-toggle="true"
  data-resizable="true"
  >
  <thead class="table-dark">
    <tr>
      @foreach ($data as $el)
      <th data-field="{{ $el['data'] }}" data-sortable="{{ isset($el['sortable']) && $el['sortable']? 'true':'false' }}">
        @if ($loop->last)
        Action
        @else
        {{ $el['title'] }}
        @endif
      </th>
      @endforeach
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<div id="datatable-pagination" class="d-flex justify-content-center m-5"></div>

@once
  @push('styles')
  <link href="//unpkg.com/jquery-resizable-columns@0.2.3/dist/jquery.resizableColumns.css" rel="stylesheet">
  @endpush
  @push('scripts')
  <script src="//unpkg.com/jquery-resizable-columns@0.2.3/dist/jquery.resizableColumns.min.js"></script>
  @endpush
@endonce

@push('scripts')
<script>
  url = '{{ $url }}';
</script>
@endpush
