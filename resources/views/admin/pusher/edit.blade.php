<x-dashing::app-layout>
    <x-slot name="header">
        Pusher Management - Edit
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('breadcrumb') }}
    </x-slot>
    <x-dashing::content-card class="col-max">
        <div class="px-5">
             <x-dashing::form ajax="true" method="PATCH" action="{{ route('pusher.update',[$model->id]) }}">
                <x-dashing::select-field name="brand_id" id="brand_id" label="Brand" :options="app(config('dashing.Models.Brand'))->query()->pluck('name','id')->toArray()" :selected="$model->brand_id ?? []"/>
                <x-dashing::select-field name="locale" id="locale" label="Locale"  :options="settings('locales')" :selected="$model->locale ?? []"/>
                <x-dashing::input-field type="text" name="title" id="title" label="Title" value="{{ $model->title ?? '' }}"/>
                <x-dashing::textarea-field name="message" id="message" label="Message" value="{{ $model->message ?? '' }}"/>
                <x-dashing::image-field name="icon" id="icon" label="Icon" :value="$model->icon ?? ''"/>
                <x-dashing::input-field  type="text" name="link" id="link" label="Link" value="{{ $model->link ?? '' }}"/>
                <x-dashing::input-field  type="number" name="timeout" id="timeout" label="Time Out (ms)" value="{{ $model->timeout ?? '5000' }}"/>
                <x-dashing::datetime-field name="scheduled_at" id="scheduled_at" label="Scheduled Date" :value="$model->scheduled_at ?? ''"/>
                <x-dashing::select-field name="event" id="event" label="Event" :options="settings('pusher_events')" :selected="$model->event ?? []"/>
                <x-dashing::select-field name="status" id="status" label="Status" :options="settings('pusher_status')" :selected="$model->status ?? []"/>
                <x-dashing::button-field class="btn btn-primary">Submit</x-dashing::button-field>
            </x-dashing::form>
        </div>
    </x-dashing::content-card>
@push('scripts')
<script>
    $(document).ready(function() {
    });
</script>
@endpush
</x-dashing::app-layout>

