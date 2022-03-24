<x-layouts.app>


    @guest

        <x-slot name="header">
            Bookfriends
        </x-slot>

        <div class="mt-8">
            Sign up to get started.
        </div>

    @endguest

    @auth

        <x-slot name="header">
            My Books
        </x-slot>

        <article class="space-y-6">
            @foreach($booksByStatus as $status => $books)
                <header>
                    <h1 class="font-bold text-xl text-slate-600">
                        {{ \App\Models\Pivot\BookUser::$statuses[$status] }}
                    </h1>
                </header>
                <section class="mt-4 space-y-3">
                    @foreach($books as $book)
                        <x-book :book="$book">
                            <x-slot name="links">
                                Links
                            </x-slot>
                        </x-book>
                    @endforeach
                </section>

            @endforeach
        </article>

    @endauth

</x-layouts.app>
