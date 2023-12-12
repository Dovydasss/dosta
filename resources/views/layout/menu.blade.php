<style>

    .custom-navbar {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem; 
        color: #000; 
    }
    .custom-navbar .nav-link {
        color: #000; 
        transition: color 0.3s, transform 0.3s; 
    }
    .custom-navbar .nav-link:hover {
        color: #007bff;
        transform: translateY(-2px);
    }
    .custom-navbar .nav-item {
        margin: 0 15px; 
    }
    .custom-navbar.fixed-bottom {
        padding-bottom: 1rem; 
    }
    .custom-navbar .flex-column .nav-item {
        margin: 10px 0; 
    }
</style>
@foreach ($menus as $menu)
    @if ($menu->menuItems->count())
        {{-- Top Menu --}}
        @if($menu->location == 'top')
            <nav class="navbar navbar-expand navbar-light bg-light custom-navbar">
                <div class="container-fluid justify-content-center">
                    <ul class="navbar-nav">
                        @foreach ($menu->menuItemsOrdered as $menuItem)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                            </li>
                        @endforeach

                        {{-- Authentication Links --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        {{-- Bottom Menu --}}
        @elseif($menu->location == 'bottom')
            <nav class="navbar navbar-expand fixed-bottom custom-navbar">
                <div class="container-fluid justify-content-center">
                    <ul class="navbar-nav">
                    @foreach ($menu->menuItemsOrdered as $menuItem) 
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>

        {{-- Left Menu --}}
        @elseif($menu->location == 'left')
            <div class="d-flex flex-column align-items-center justify-content-center vh-100 custom-navbar navbar navbar-expand navbar-light bg-light" style="position: fixed; left: 0; top: 0; width: 250px;">
                <ul class="nav flex-column">
                @foreach ($menu->menuItemsOrdered as $menuItem)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

        {{-- Right Menu --}}
        @elseif($menu->location == 'right')
            <div class="d-flex flex-column align-items-center justify-content-center vh-100 custom-navbar navbar navbar-expand navbar-light bg-light" style="position: fixed; right: 0; top: 0; width: 250px;">
                <ul class="nav flex-column">
                @foreach ($menu->menuItemsOrdered as $menuItem)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @else
        <p>No items in this menu.</p>
    @endif
@endforeach

