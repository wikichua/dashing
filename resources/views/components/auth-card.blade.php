<div class="text-center mt-4">
    <p class="lead">
        {{ $message }}
    </p>
</div>

<div class="card">
    <div class="card-body">
        <div class="m-sm-4">
            <div class="text-center">
                <x-dashing::application-logo class="fa-7x" />
            </div>
            {{ $slot }}
        </div>
    </div>
</div>
