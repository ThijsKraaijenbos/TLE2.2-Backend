@props(['fruits'])

<x-layout>

    @foreach($fruits as $fruit)
        <x-fruit-index-item :fruit="$fruit"></x-fruit-index-item>
    @endforeach

</x-layout>
