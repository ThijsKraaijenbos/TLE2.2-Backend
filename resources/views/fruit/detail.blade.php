@props(['fruit'])

<x-layout>

    <h1>{{ $fruit->name }}</h1>

    <p>{{ $fruit->description }}</p>

    <div class="imageContainer">
        <img
            src="{{ str_starts_with($fruit->big_img_file_path, 'storage/') ? asset($fruit->big_img_file_path) : $fruit->big_img_file_path }}"
            alt="">
    </div>

    <div class="imageContainer">
        <img
            src="{{ str_starts_with($fruit->small_img_file_path, 'storage/') ? asset($fruit->small_img_file_path) : $fruit->small_img_file_path }}"
            alt="">
    </div>

</x-layout>
