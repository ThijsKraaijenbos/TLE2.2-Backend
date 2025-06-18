<x-layout>

    <h1>Create a new fruit</h1>

    <form method="POST" action="{{route('fruit.admin-store')}}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" maxlength="255" required name="name" id="name" value="{{ old('name') }}">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="name" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Price</label>
            <input type="number" step="0.01" min="0" required name="price" id="price" value="{{ old('price') }}">
        </div>

        <div>
            <label for="serving_size">Serving Size</label>
            <input type="text" maxlength="255" required name="serving_size" id="serving_size"
                   value="{{ old('serving_size') }}">
        </div>

        <div>
            <label for="weight">Weight in grams</label>
            <input type="number" step="1" min="0" required name="weight" id="weight" value="{{ old('weight') }}">
        </div>

        <button type="submit">Create fruit</button>

    </form>

</x-layout>
