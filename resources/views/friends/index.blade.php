<x-layouts.app>

    <x-slot name="header">
        Friends
    </x-slot>

    <main class="space-y-6">
        @if($friends->count())
            <artice>
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Friends
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $friends as $friend)
                        <div>
                            {{ $friend->name }}
                        </div>
                    @endforeach
                </section>
            </artice>
        @endif
        @if($pendingFriends->count())
            <article>
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Pending friend requests
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $pendingFriends as $pendingFriend)
                        <div>
                            {{ $pendingFriend->name }}
                        </div>
                    @endforeach
                </section>
            </article>
        @endif
        @if($requestingFriends->count())
            <article>
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        Friend requests
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach( $requestingFriends as $requestingFriend)
                        <div>
                            {{ $requestingFriend->name }}
                        </div>
                    @endforeach
                </section>
            </article>
        @endif
    </main>


</x-layouts.app>
