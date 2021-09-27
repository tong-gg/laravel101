<nav class="flex items-center justify-between flex-wrap bg-teal p-6">
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
            <svg class="h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-2xl lg:flex-grow">
            <a href="{{ route('apartments.index') }}">Apartment List |</a>
            <a href="{{ route('tasks.index') }}"
            class="@if(\Request::routeIs('tasks.*')) bg-gray-700 @endif text-white hover:bg-blue-400">TODO List |</a>
        {{-- there is a trick to active a href, check it out --}}
            <a href="{{ route('tags.index') }}">Tags</a>
        </div>
        <div>
            <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal hover:bg-white mt-4 lg:mt-0">Download</a>
        </div>
    </div>
    @if (Auth::check())
        <a href="#">
            {{ Auth::user()->name }}
        </a>
        {{-- logout send through form POST method --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button class="text-black" px-3 py-2 rounded-m type="submit">
                LOGOUT
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">
            Login
        </a>
        <a href="{{ route('register') }}">
            Register
        </a>
    @endif
</nav>
