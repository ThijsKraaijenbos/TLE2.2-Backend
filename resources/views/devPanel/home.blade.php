<x-layout>

    @guest

        <h1>Admin panel</h1>

        <p>Please log in to continue</p>

        <a href="{{route('login')}}">Login</a>

    @endguest

    @auth

        @can('admin')

            <h1>Admin panel</h1>

            <p>Use the nav bar</p>

        @else

            <h1>You do not have access to this panel</h1>

        @endcan

    @endauth

</x-layout>
