<x-layouts.app>

    <x-slot name="header">
        Sign up
    </x-slot>

    <form action="{{ route('register') }}" method="POST" class="mt-4 space-y-4">
        @csrf

        <div class="space-y-1">
            <label for="name" class="block">Your name</label>
            <input type="text" name="name" id="name" placeholder="i.e Mabel" class="rounded block w-full">
        </div>

        <div class="space-y-1">
            <label for="email" class="block">Email Address</label>
            <input type="email" name="email" id="email" placeholder="i.e you@mail.com" class="rounded block w-full">
        </div>

        <div class="space-y-1">
            <label for="password" class="block">Password</label>
            <input type="password" name="password" id="password" placeholder="i.e you@mail.com" class="rounded block w-full">
        </div>

        <button type="submit" class="bg-slate-200 px-3 py-2 rounded">
            Create account
        </button>

    </form>

</x-layouts.app>
