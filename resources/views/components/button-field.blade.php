<div class="col-sm-10 ms-sm-auto">
    <button {{ $attributes->merge(['type' => 'submit']) }}>
        {{ $slot }}
    </button>
</div>
