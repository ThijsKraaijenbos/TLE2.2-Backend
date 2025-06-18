<nav>

    <p>Fruit app admin panel</p>

    @guest
        <a href="{{route('register')}}">Register account</a>
        <a href="{{route('login')}}">Login</a>
    @endguest

    @auth

        @can('admin')
            <a href="{{route('adminFruits')}}">Fruit</a>
        @endcan

        {{--      This logout form has been copy and pasted from Breeze's dashboard --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>

    @endauth

</nav>
