@props(['fruits'])

<x-layout>

    <h1>Fruit index</h1>

    <section>
        <a href="{{ route('fruit.admin-create') }}">Create new</a>
    </section>

    <section>
    @foreach($fruits as $fruit)
        <x-fruit-index-item :fruit="$fruit"></x-fruit-index-item>
    @endforeach
    </section>

</x-layout>
