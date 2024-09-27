<nav class="navbar navbar-expand-lg navbar-light fixed-top menu">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-brand page-scroll" href="{{ url('') }}">
                <img src="{{ asset('images/real_estate1.svg') }}" class="d-none d-md-inline" style="height: 40px;">
                <img src="{{ asset('images/home.svg') }}" class="d-md-none" style="height: 40px;">
            </a>
        </div>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: #fff;"></span>
        </button>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav ms-auto align-items-center">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item"><a class="nav-link page-scroll text-white" href="{{ url('property/index') }}">RENTALS</a></li>
                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ strtoupper(auth()->user()->name) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a href="{{ url('account/dashboard') }}" class="dropdown-item">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="write-review bg-light rounded-5" href="{{ url('write_a_review/step1') }}">WRITE REVIEW</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ url('login') }}" class="nav-link page-scroll text-white">LOGIN<i class="bi bi-arrow-up-right p-3 hide-on-mobile"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="write-review bg-light rounded-5" href="{{ url('login?source=write_review') }}">WRITE REVIEW</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>