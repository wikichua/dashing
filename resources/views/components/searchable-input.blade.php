<form class="d-inline-block" action="{{ route('global.search') }}">
    <div class="input-group input-group-navbar">
        <input type="text" class="form-control" placeholder="Search…" aria-label="Search" name="q" value="{{ request()->input('q','') }}" id="globalSearch" autocomplete="off">
        <button class="btn" type="button">
            <i class="align-middle" data-feather="search"></i>
        </button>
    </div>
    <div class="list-group position-absolute shadow invisible col-8 col-sm-6 col-md-6 col-lg-4" style="z-index: 10;" id="globalSuggest"></div>
</form>
@once
@push('scripts')
<script id="globalSearchTemplate" type="text/x-lodash-template">
<% _.forEach(data, function(item) { %>
<a href="<%- item.url %>" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
        <strong class="mb-1"><%- item.title %></strong>
        <small><%- item.created_at %></small>
    </div>
    <p class="mb-1 small"><%= item.desc %></p>
</a>
<% }); %>
<button type="button" id="goGlobalSearch" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
        <strong class="mb-1">more...</strong>
    </div>
</button>
</script>
<script>
$(function() {
    $(document).on('keyup', '#globalSearch', function(event) {
        var searchTerm = $(this).val();
        if ($('#globalSuggest').hasClass('invisible') == false) {
            $('#globalSuggest').addClass('invisible');
        }
        if (searchTerm.length >= 4) {
            $('#globalSuggest').removeClass('invisible');
            axios.post(route('global.suggest'), {
              q: searchTerm
            }).then((response) => {
                var templateFn = _.template($('#globalSearchTemplate').html());
                var templateHTML = templateFn(response);
                $('#globalSuggest').html(templateHTML);
            }).catch((error) => {
              console.error(error);
            }).finally(() => {
              // TODO
            });
        }
    });
    $(document).on('click', '#goGlobalSearch', function(event) {
        event.preventDefault();
        $('#globalSearchForm').submit();
    });
});
</script>
@endpush
@endonce
