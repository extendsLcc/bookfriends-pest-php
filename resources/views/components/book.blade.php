@props(['book'])

<article class="bg-slate-100 p-6 rounded flex justify-between items-center">
    <section>
        <h2>{{ $book->title }}</h2>
        <p class="text-slate-600 text-sm font-normal">
            {{ $book->author }}
        </p>
    </section>

    @if(isset($links))
        <div>
            <a href="/books/{{ $book->id }}/edit" class="text-blue-500 text-sm">Edit</a>
        </div>
    @endif
</article>
