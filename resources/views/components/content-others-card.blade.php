@props(['model' => null, 'prepend' => '', 'append' => ''])
<x-dashing::content-card class="col-4">
    <x-slot name="title">Others</x-slot>
    <div class="px-5">
        {{ $prepend ?? '' }}
        @if ($model)
            @if (isset($model->created_at))
            <x-dashing::display-field type="text" name="created_at" id="created_at" label="Created At" :value="$model->created_at ?? ''"/>
            @endif
            @if (isset($model->created_by) || isset($model->creator->name))
            <x-dashing::display-field type="text" name="created_by" id="created_by" label="Created By" :value="$model->creator->name ?? $model->created_by"/>
            @endif
            @if (isset($model->updated_at))
            <x-dashing::display-field type="text" name="updated_at" id="updated_at" label="Updated At" :value="$model->updated_at ?? ''"/>
            @endif
            @if (isset($model->updated_by) || isset($model->modifier->name))
            <x-dashing::display-field type="text" name="updated_by" id="updated_by" label="Updated By" :value="$model->modifier->name ?? $model->updated_by"/>
        @endif
        @endif
        {{ $append ?? '' }}
    </div>
</x-dashing::content-card>
