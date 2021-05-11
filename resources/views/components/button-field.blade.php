<div class="mb-3 row">
    <div class="offset-3 col-sm-9 ms-sm-auto">
        <button {{ $attributes->merge(['type' => 'submit']) }}>
            {{ $slot }}
        </button>
    </div>
</div>
