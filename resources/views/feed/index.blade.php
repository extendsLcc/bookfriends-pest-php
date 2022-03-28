<x-layouts.app>

    <x-slot name="header">
        Feed
    </x-slot>

    <article class="mt-8 space-y-6">
        @foreach($books as $book)
            <section class="block space-y-2">
                <div>
                    {{ $book->user->first()->name }} {{ $book->book_user->action }} {{ $book->title }}
                </div>
                <x-book :book="$book" />
            </section>
        @endforeach
    </article>

</x-layouts.app>
