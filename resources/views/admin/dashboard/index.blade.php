<x-dashing::app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <x-slot name="breadcrumb">
        {{ \Breadcrumbs::render('home') }}
    </x-slot>
    <x-dashing::content-card class="col-12">
        <x-slot name="title">
            Welcome!
        </x-slot>
        Congratulation! You are now logged in!
        <x-dashing::queue-dashboard />
    </x-dashing::content-card>
</x-dashing::app-layout>
