<div class="py-3 row border-light border-top">
    <div class="offset-3 col-sm-9 ms-sm-auto">
        <button {{ $attributes->merge(['type' => 'submit']) }}>
            {{ $slot }}
        </button>
    </div>
</div>
