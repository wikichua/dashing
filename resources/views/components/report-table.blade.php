@props(['data'])
@php
  $fields = count($data)? array_keys((array)$data[0]):[];
@endphp
<div class="table-responsive table-responsive-sm">
  <table class="table mb-0 table-hover table-striped table-sm"
    data-search="true"
    data-show-toggle="true"
    data-show-fullscreen="true"
    data-show-columns="true"
    data-show-columns-toggle-all="true"
    data-minimum-count-columns="2"
    data-show-pagination-switch="true"
    data-pagination="true"
    data-page-list="[10, 25, 50, 100, all]"
    data-show-footer="true"
    >
    <thead>
      <tr>
        @foreach ($fields as $field)
        <th scope="col">
          {{ str_replace('_',' ',\Str::title(\Str::snake($field))) }}
        </th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $model)
      <tr>
        @foreach ($fields as $field)
        <td>{{ isset($model[$field])? $model[$field]:(isset($model->{$field})? $model->{$field}:'') }}</td>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@push('scripts')
<script>
$(function() {
  $('.table').bootstrapTable();
});
</script>
@endpush
