<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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
</head>
<body>

<div class="d-flex">
    @include('partials.sidebar')

    <main class="flex-fill p-4" style="margin-left:260px;">
    @yield('content')
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const wrapper = document.getElementById('categoryWrapper');
const btnLeft = document.getElementById('btnLeft');
const btnRight = document.getElementById('btnRight');

function scrollCategory(direction) {
    wrapper.scrollBy({
        left: direction * 120,
        behavior: 'smooth'
    });

    setTimeout(updateButtons, 300);
}

function updateButtons() {
    btnLeft.disabled = wrapper.scrollLeft <= 0;
    btnRight.disabled =
        wrapper.scrollLeft + wrapper.clientWidth >= wrapper.scrollWidth - 1;
}

wrapper.addEventListener('scroll', updateButtons);
window.addEventListener('load', updateButtons);
</script>

</body>
</html>
