<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yune.co</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Sidebar CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apps.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/overview.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/categoriviews.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/productviews.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/historyorder.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/paymenton.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/categorishow.css') }}">

    <style>
        :root {
            --sidebar-width: 280px;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            main {
                margin-left: 0 !important;
                padding: 15px !important;
            }
            .mobile-header {
                display: flex !important;
            }
        }

        .mobile-header {
            display: none;
            background: #7da6ff;
            padding: 10px 15px;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1040;
            color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .mobile-logo img {
            height: 32px;
            object-fit: contain;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1045;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show {
            display: block;
        }

        /* Cart Drawer Styles */
        .cart-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: white;
            z-index: 1060;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .cart-drawer.show {
            transform: translateX(0);
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
            border: 2px solid #7da6ff;
        }
    </style>
</head>
<body>

<div class="mobile-header">
    <button class="btn text-white p-0 border-0" id="sidebarToggle">
        <i class="bi bi-list fs-1"></i>
    </button>
    <div class="mobile-logo">
        <img src="{{ asset('assets/images/yy.png') }}" alt="Logo">
    </div>
    <button class="btn text-white p-0 border-0 position-relative" id="cartToggle">
        <i class="bi bi-cart3 fs-2"></i>
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </button>
</div>

<div class="cart-drawer" id="cartDrawer">
    @include('partials.cart', ['isDrawer' => true])
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="main-wrapper d-flex" style="width: 100%; overflow-x: hidden;">
    @include('partials.sidebar')

    <main class="flex-fill p-4" style="margin-left: var(--sidebar-width); max-width: 100%; overflow-x: hidden;">
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const wrapper = document.getElementById('categoryWrapper');
const btnLeft = document.getElementById('btnLeft');
const btnRight = document.getElementById('btnRight');

function scrollCategory(direction) {
    if (wrapper) {
        wrapper.scrollBy({
            left: direction * 120,
            behavior: 'smooth'
        });
        setTimeout(updateButtons, 300);
    }
}

function updateButtons() {
    if (wrapper && btnLeft && btnRight) {
        btnLeft.disabled = wrapper.scrollLeft <= 0;
        btnRight.disabled =
            wrapper.scrollLeft + wrapper.clientWidth >= wrapper.scrollWidth - 1;
    }
}

if (wrapper) {
    wrapper.addEventListener('scroll', updateButtons);
}
window.addEventListener('load', updateButtons);

const sidebarToggle = document.getElementById('sidebarToggle');
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.add('show');
        document.getElementById('sidebarOverlay').classList.add('show');
    });
}

const sidebarOverlay = document.getElementById('sidebarOverlay');
if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.remove('show');
        document.getElementById('cartDrawer').classList.remove('show');
        sidebarOverlay.classList.remove('show');
    });
}

const cartToggle = document.getElementById('cartToggle');
const cartDrawer = document.getElementById('cartDrawer');
const cartClose = document.getElementById('cartClose');

if (cartToggle && cartDrawer) {
    cartToggle.addEventListener('click', function() {
        cartDrawer.classList.add('show');
        sidebarOverlay.classList.add('show');
    });
}

if (cartClose && cartDrawer) {
    cartClose.addEventListener('click', function() {
        cartDrawer.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    });
}
</script>

</body>
</html>
