<x-layouts.app>

    <x-slot name="header">
        Friends
    </x-slot>

    <main class="space-y-6">

        <article class="block">
            <header>
                <h1 class="font-bold text-xl text-slate-600">
                    Friends
                </h1>
            </header>
            <section>
                <form action="/friends" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <div class="space-y-1">
                        <label for="email" class="block">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="i.e you@mail.com" class="rounded block w-full">

                        @error('email')
                            <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="bg-slate-200 px-3 py-2 rounded">
                        Send request
                    </button>
                </form>
            </section>
        </article>

        @if($friends->count())
            <artice class="block">
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Friends
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $friends as $friend)
                        <div>
                            {{ $friend->name }} ({{ $friend->email }})
                        </div>
                    @endforeach
                </section>
            </artice>
        @endif
        @if($pendingFriends->count())
            <article class="block">
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Pending friend requests
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $pendingFriends as $pendingFriend)
                        <div>
                            {{ $pendingFriend->name }} ({{ $pendingFriends->email }})
                        </div>
                    @endforeach
                </section>
            </article>
        @endif
        @if($requestingFriends->count())
            <article class="block">
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Friend requests
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $requestingFriends as $requestingFriend)
                        <div>
                            {{ $requestingFriend->name }} ({{ $requestingFriend->email }})
                            <form action="/friends/{{ $requestingFriend->id }}" method="post" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="text-blue-500">Accept</button>
                            </form>
                        </div>
                    @endforeach
                </section>
            </article>
        @endif
    </main>


</x-layouts.app>
