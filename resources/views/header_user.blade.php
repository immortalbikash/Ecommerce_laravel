<nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Mero Store</a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('cart.index') }}" class="nav-link" style="margin-right: 15px">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Cart</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false" style="margin-right: 10px">
                    @guest  My Account
                    @else   {{ auth()->user()->first_name ?? 'My Account' }}    {{-- login bhayo bhani name show garcha --}}
                    @endguest
                </a>
                {{-- login nahuda yo dekhaune --}}
                @guest
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('loginlogin') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    </ul>
                @else
                {{-- login huda yo dekhaune --}}
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('user_profile') }}">My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @endguest
            </li>
        </ul>
    </div>
</nav>
<!-- Header-->
