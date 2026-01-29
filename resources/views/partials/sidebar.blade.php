<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('assets/images/yy.png') }}" alt="Logo">
    </div>

    <nav class="sidebar-menu">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Overview</span>
        </a>

        <a href="/category" class="{{ request()->is('category*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            <span>Category</span>
        </a>

        <a href="/product" class="{{ request()->is('product*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Product</span>
        </a>

        <a href="/history-order" class="{{ request()->is('history-order*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span>History</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="dropdown dropup">
            <button class="setting-btn" data-bs-toggle="dropdown">
                <i class="bi bi-gear"></i>
            </button>

            <ul class="dropdown-menu">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
